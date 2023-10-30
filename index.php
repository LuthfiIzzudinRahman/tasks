<?php
include 'config.php'; // Memasukkan file config.php untuk koneksi database

// Fungsi untuk melakukan pencarian berdasarkan title atau status
if (isset($_POST['search_button'])) {
    $searchKeyword = $_POST['search'];
    $sql = "SELECT * FROM $tableName WHERE title LIKE '%$searchKeyword%' OR status LIKE '%$searchKeyword%'";
    $result = $conn->query($sql);
}

// Fungsi untuk menambahkan data
if (isset($_POST['submit'])) {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $status = $_POST['status'];
    $id = isset($_POST['id']) ? $_POST['id'] : null;

    if (isset($id) && $id != "") {
        $sql = "UPDATE $tableName SET status = '$status', updated_at = NOW() WHERE id = $id";
    } else {
        $sql = "INSERT INTO $tableName (title, description, status) VALUES ('$title', '$description', '$status')";
    }


    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil ditambahkan";
        header("Location: index.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk menghapus data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM $tableName WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil dihapus";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fungsi untuk mengupdate data
if (isset($_GET['update'])) {
    $update_id = $_GET['update'];

    // Query untuk mengambil data berdasarkan ID
    $update_sql = "SELECT * FROM $tableName WHERE id=$update_id";
    $update_result = $conn->query($update_sql);


    if ($update_result->num_rows == 1) {
        $update_row = $update_result->fetch_assoc();
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>CRUD Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid" style="background-color:#fff300">
        <div class="d-flex justify-content-center mb-3">
            <h1 class="display-4" style="color:#0069ac; font-weight: bold;">Task Manager</h2>
        </div>
        <div class="card mb-3">
            <div class="card-body">
                <form method="post" action="">
                    <input type=hidden name="id" value="<?php echo isset($update_row['id']) ? $update_row['id'] : ''; ?>">
                    <div class="form-group mb-3">
                        <label for="title">Title:</label>
                        <input class="form-control" type="text" name="title" value="<?php echo isset($update_row['title']) ? $update_row['title'] : ''; ?>" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="description">Description:</label>
                        <textarea class="form-control" name="description" required><?php echo isset($update_row['description']) ? $update_row['description'] : ''; ?></textarea>
                    </div>
                    <div class="form-froup mb-3">
                        <div id="status">
                            <label for="status">Status:</label>
                            <select name="status" class="form-control">
                                <option value="Pending" <?php echo (isset($update_row['status']) && $update_row['status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="In Progress" <?php echo (isset($update_row['status']) && $update_row['status'] == 'In Progress') ? 'selected' : ''; ?>>In Progress</option>
                                <option value="Completed" <?php echo (isset($update_row['status']) && $update_row['status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                            </select>
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input class="btn btn-primary" style="background-color: #0069ac;" type="submit" name="submit" value="Submit">
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <form method="post" action="" class="mb-3">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <input type="text" name="search" id="search" class="form-control" placeholder="Search by title or status">
                                </div>
                            </div>
                            <div class="col-8">
                                <input class="btn btn-primary" style="background-color: #0069ac;" type="submit" name="search_button" value="Search">
                            </div>
                        </div>
                    </div>
                </form>

                <div>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                            <?php

                            //Fungsi untuk search
                            if (isset($_POST['search_button'])) {
                                $searchKeyword = $_POST['search'];
                                $sql = "SELECT * FROM $tableName WHERE title LIKE '%$searchKeyword%' OR LOWER(status) = LOWER('$searchKeyword')";
                            } else {
                                // Fungsi untuk mengambil data
                                $sql = "SELECT * FROM $tableName";
                            }
                            $result = $conn->query($sql);
                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["id"] . "</td>";
                                    echo "<td>" . $row["title"] . "</td>";
                                    echo "<td>" . $row["description"] . "</td>";
                                    echo "<td>" . $row["status"] . "</td>";
                                    echo "<td>" . $row["created_at"] . "</td>";
                                    echo "<td>" . $row["updated_at"] . "</td>";
                                    echo "<td><a class='btn btn-primary' style='background-color: #0069ac;' href='index.php?delete=" . $row["id"] . "'>Hapus</a><span> <span><a class='btn btn-primary' style='background-color: #0069ac;' href='index.php?update=" . $row["id"] . "'>Update</a></td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='7'>Tidak ada data</td></tr>";
                            }


                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>

<?php
$conn->close(); // Tutup koneksi database
?>