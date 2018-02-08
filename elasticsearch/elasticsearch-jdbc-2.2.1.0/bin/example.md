```
# 当前脚本的绝对路径
DIR="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
bin=${DIR}/../bin
lib=${DIR}/../lib

echo '
{
    "type" : "jdbc",
    "jdbc" : {
        # 链接 mysql 的 test 数据库
        "url" : "jdbc:mysql://localhost:3306/test",
        # mysql 用户
        "user" : "root",
        # mysql 密码
        "password" : "123456",
        # 计划任务状态文件
        "statefile" : "statefile-article.json",
        # 计划任务时间 这里是每分钟执行一次
        "schedule" : "0 0-59 0-23 ? * *",
        # 执行导入的sql 语句
        "sql" : [
            {
                "statement" : "select *, id as _id from article where update_time > ?",
                "parameter" : [ "$metrics.lastexecutionstart" ]
            }
        ],
        # 索引名称 jdbctest
        "index" : "jdbctest",
        # 类型名称 article
        "type" : "article",
        # 类型设置
        "index_settings" : {
            "analysis" : {
            "analyzer" : {
                "ik" : {
                        # 涉及到中文使用ik 分词
                    "tokenizer" : "ik"
                }
            }
        }
        },
        # 类型中的字段映射
        "type_mapping": {
            # 类型名称
            "article" : {
                "properties" : {
                    # 对应的字段
                    "id" : {
                        # 字段类型
                        "type" : "integer",
                        # 当成一个准确的值进行索引(全匹配)
                        "index" : "not_analyzed"
                    },
                    "subject" : {
                        "type" : "string",
                        "analyzer" : "ik"
                    },
                    "author" : {
                        "type" : "string",
                        "analyzer" : "ik"
                    },
                    "create_time" : {
                        "type" : "date"
                    },
                    "update_time" : {
                        "type" : "date"
                    }
                }
            }
        }
    }
}
' | java \
    -cp "${lib}/*" \
    -Dlog4j.configurationFile=${bin}/log4j2.xml \
    org.xbib.tools.Runner \
    org.xbib.tools.JDBCImporter
```
