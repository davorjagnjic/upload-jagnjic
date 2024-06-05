<?php
include 'config.php';

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $MySQL->prepare("SELECT id, gallery_title, gallery_name FROM gallery WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id, $gallery_title, $gallery_name);
    $stmt->fetch();
    $stmt->close();

    if($gallery_name) {
   
        unlink('images/' . $gallery_name);

        $stmt = $MySQL->prepare("DELETE FROM gallery WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();

        echo "Image deleted successfully!";
    } else {
        echo "Image not found!";
    }
} else {
    echo "Invalid request!";
}
?>
