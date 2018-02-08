### 创建索引 yii2blog/articles
```
curl -v -X PUT "http://localhost:9200/yii2blog?pretty=true" -d "json"
curl -v -X POST "http://localhost:9200/yii2blog?pretty=true" -d "json"
{
    "settings":{
        "refresh_interval": "5s", //5秒后刷新
        "number_of_shards": 1,    //分片，目前1台机器，所以为1
        "number_of_replicas": 0   //副本为0
    },
    "mappings": {
        "_default_": {
            "_all": {
                "enabled": true   //所有数据都索引
            }
        },
        "products": {             //名称可自定义，可定义为表名
            "dynamic": false ,    //动态映射
            "properties": {
                "productid": {
                    "type": "long"
                },
                "title": {
                    "type": "string",
                    "index": "analyzed",
                    "analyzer": "ik"
                },
                "descr": {
                    "type": "string",
                    "index": "analyzed",
                    "analyzer": "ik"
                }
            }
        }
    }
}
```

### 删除索引 yii2blog/articles
```
curl -v -X DELETE "localhost:9200/yii2blog?pretty=true"
```

### 添加记录
```
curl -v X PUT "http://localhost:9200/yii2blog/articles/1?pretty=true" -d "json"
curl -v X POST "http://localhost:9200/yii2blog/articles/1?pretty=true" -d "json"
{
    "article_id" : 1,
    "post_title" : "这是文章标题",
    "post_excerpt" : "这是文章描述"
}
```

### 查看记录
```
curl -v X GET "http://localhost:9200/yii2blog/articles/1?pretty=true"
```

### 删除记录
```
curl -v X DELETE "http://localhost:9200/yii2blog/articles/1?pretty=true"
```

### 更新记录
```
curl -v X PUT "http://localhost:9200/yii2blog/articles/1?pretty=true" -d "json"
curl -v X POST "http://localhost:9200/yii2blog/articles/1?pretty=true" -d "json"
{
    "article_id" : 1,
    "post_title" : "更新文章标题",
    "post_excerpt" : "更新文章描述"
}
```

### 数据查询

###### 1. 返回 elastic 中所有记录
```
curl -v X GET "http://localhost:9200/_search?pretty=true"
```

###### 2. 返回 yii2blog 中所有记录
```
curl -v X GET "http://localhost:9200/yii2blog/_search?pretty=true"
```

###### 3. 返回 yii2blog/articles 中所有记录
```
curl -v X GET "http://localhost:9200/yii2blog/articles/_search?pretty=true"
```

### 全文搜索

###### 1. 使用 Match 查询，指定的匹配条件是 post_excerpt 字段里面包含"描述"这个词
```
curl -v X GET "http://localhost:9200/yii2blog/articles/_search?pretty=true" -d "json"
{
  "query" : { "match" : { "post_excerpt" : "描述" }}
}
```

###### 2. 返回2两条记录（Elastic 默认一次返回10条结果）
```
curl -v X GET "http://localhost:9200/yii2blog/articles/_search?pretty=true" -d "json"
{
  "query" : { "match" : { "post_excerpt" : "描述" }},
  "size": 2
}
```

###### 3. 从位置3开始（默认是从位置0开始），只返回5条结果。
```
curl -v X GET "http://localhost:9200/yii2blog/articles/_search?pretty=true" -d "json"
{
  "query" : { "match" : { "post_excerpt" : "描述" }},
  "from": 3,
  "size": 5
}
```
###### 4. 搜索的是 "描述" or "文章"。
```
curl -v X GET "http://localhost:9200/yii2blog/articles/_search?pretty=true" -d "json"
{
  "query" : { "match" : { "post_excerpt" : "描述 文章" }}
}
```

###### 5. 搜索的是 "描述" and "文章"，必须使用布尔查询。
```
curl -v X GET "http://localhost:9200/yii2blog/articles/_search?pretty=true" -d "json"
{
    "query": {
        "bool": {
            "must": [
                { "match": { "post_excerpt": "描述" } },
                { "match": { "post_excerpt": "文章" } }
            ]
        }
    }
}
```
- - -
参考：[全文搜索引擎 Elasticsearch 入门教程](http://www.ruanyifeng.com/blog/2017/08/elasticsearch.html)
