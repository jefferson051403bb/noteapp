<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <!-- <link rel="stylesheet" href="css/dashboard.css" /> -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
    />
  </head>
  <style>
    body{
      background-color: #D20062;
      display: flex;
      justify-content: center;
      align-items: center;
    }
  .card{

    background-color:aliceblue ;
    padding: 30px;
    line-height: 2;
    width: 800px;
    height: 700px;
    display: flex;
    justify-content: center;
    align-items: center ;
    border-radius: 12px;
    flex-direction: column;
    background-color: #fbfbfb7b;
    color: white;
  }
  input, textarea{
    width: 550px;
    background: ;
    border: none;
    background-color: #06060632;
    border-radius: 8px;
    color: white;
    resize: none;
  }
  input{
    height: 40px;
    font-size: 20px;
    font-weight: bold;
    border-bottom: solid 1px !important;
  }
  textarea{
    height: 200px;
    font-size: 18px;
    font-weight: 300;
  }
  label{
    font-size: 18px;
    font-weight: 200;
  }
  button{
    width: 120px;
    height: 35px;
    background-color: #D20062;
    font-size: 16px;
    font-weight: bold;
    color: white;
    border: white;
    border-radius: 8px;
  }
  .btn-Cont{
    display: flex;
    width: 100%;
    flex-direction: row;
    justify-content: space-evenly;
  }
  .btn-Cont a{
    font-size: 20px;
    font-weight: bold;
    color: white;
    text-decoration: none;
  }

  </style>
  <body>
    <div class="col-md-4 border-right"style="margin-top:40px;">
      <div class="card">
        <div class="card-header"></div>

        <h1>Edit Note</h1>
        <?php
include_once 'includes/db_connectors.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST["id"])) {
        $upId = $_POST["id"];

        // Check if connection is successful
        $conn = connectDB();
        if ($conn) {
            $stmt = $conn->prepare("SELECT * FROM notes WHERE n_id = ?");
        $stmt->execute([$upId]); $note = $stmt->fetch(PDO::FETCH_ASSOC); ?>
        <div class="card-body" style="background-color: transparent">
          <form method="post" action="includes/update_note_process.php">
            
            <input
              type="hidden"
              name="note_id"
              value="<?php echo $note['n_id']; ?>"
            />
       
              <label for="noteTitle">Title</label>
              <br>
              <input
                type="text"
                class="form-control"
                id="noteTitle"
                name="title"
                value="<?php echo $note['title']; ?>"/>
                <br>
                <br>

              <label for="note">Content</label>
              <br>
              <textarea
                class="form-control"
                id="content"
                name="note_content"
                rows="23"
              >
<?php echo $note['content']; ?></textarea
              >
              <br><br>
            <div class="btn-Cont">
            <button type="submit" class="btn btn-secondary">Update</button>
            <a href="dashboard.php" class="btn btn-danger">Cancel</a>
            </div>
          </form>
        </div>
        <?php
        }
    }
}
?>
      </div>
    </div>
  </body>
</html>
