<?php 
require_once(__DIR__ . "/config.php");
require_once(__DIR__ . "/PDO.class.php");

$DB = new Db(DBHost, DBPort, DBName, DBUser, DBPassword);

if(isset($_POST['action']))
{
    if($_POST['action'] == 'Save')
    {   
        if($_POST['name'] && $_POST['phone'])
        {
            $result = $DB->query("INSERT INTO test(name,phone) VALUES(?,?)", array($_POST['name'],$_POST['phone']));
            if($result)
               $msg = "New Record Added.";
        }
        else
            $msg = "Name and Phone should not be empty";
    }
    elseif($_POST['action'] == 'Delete')
    {
        $result = $DB->query("DELETE FROM test WHERE 1");
        if($result)
           $msg = "Records Deleted.";
    }
}
$result = $DB->query("SELECT * FROM test WHERE 1");
// var_dump($result);
?>
<?php require_once(__DIR__ . "/header.php"); ?>
<div class="jumbotron">
    <h1>Add New Data</h1>
    <?php if(isset($msg)){ ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?php echo $msg; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php } ?>
    <form class="form-inline" method="post" action="./data.php">
    <div class="form-group mx-sm-3 mb-2">
        <label for="input1" class="sr-only">Name</label>
        <input type="text" name="name" class="form-control" id="input1" placeholder="Name">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="input2" class="sr-only">Phone</label>
        <input type="text" name="phone" class="form-control" id="input2" placeholder="Phone">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="submit" class="btn btn-primary mb-2" value="Save" name="action"/>
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <input type="submit" class="btn btn-danger mb-2" value="Delete" name="action"/>
    </div>
    </form>
</div>
<div class="card">
    <div class="card-body">
        <table class="table table-sm table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Phone</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($result as $item){ ?>
                <tr class="jumbotron">
                    <td><?php echo $item['name']; ?></td>
                    <td><?php echo $item['phone']; ?></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php require_once(__DIR__ . "/footer.php"); ?>