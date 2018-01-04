<div class="wrapper wrapper-content animated fadeIn" >
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">

                <div class="grid-item col-md-12" data-system="0" data-widget="SystemInfo" style="position: absolute; left: 0%;">
                    <div class="dashboard-box">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                 <h3 class="panel-title text-info" style="font-size: 16px;">系统信息</h3>
                            </div>
                            <div class="panel-body home-info">
                                <ul class="list-unstyled col-md-6">
                                    <table class="table table-striped col-md-6">
                                        <tbody>
                                            <?php foreach ($system_info as $k => $vo): ?>
                                                <tr><td><b><?= $k ?></b></td><td><?= $vo ?></td></tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
