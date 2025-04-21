<?php
/**
 * Entity deletion script for BikeStores IT employees.
 *
 * Allows IT employees to delete a product, brand, category, stock, or store via AJAX requests.
 * Sends DELETE requests to the BikeStores API based on the entity type and ID.
 * Displays a success or error message based on the API response and redirects to the appropriate management page.
 *
 * @package view\IT
 * @version 1.0
 */
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        let sup = "<?php echo $_GET['sup']; ?>";
        let id = "<?php echo $_GET['id']; ?>";

        if (sup == "produit") {

            $.ajax({
                url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionDelete=deleteProduct&id=${id}&KEY=e8f1997c763`,
                type: "DELETE",
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        alert("Deletion successful!");
                        window.location.href = "index.php?action=GestionIT&click=produit";
                    } else {
                        alert("Error during deletion because there is still stock in the store!");

                        window.location.href = "index.php?action=GestionIT&click=produit";
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error during deletion because there must still be stock in the store!");
                    window.location.href = "index.php?action=GestionIT&click=produit";
                }
            });
        } else if (sup == "brand") {
            $.ajax({
                url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionDelete=deleteBrand&id=${id}&KEY=e8f1997c763`,
                type: "DELETE",
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        alert("Deletion successful!");
                        window.location.href = "index.php?action=GestionIT&click=brand";
                    } else {
                        alert("Error during deletion because a product in the store belongs to this brand!");

                        window.location.href = "index.php?action=GestionIT&click=brand";
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error during deletion because there must still be stock in the store!");
                    window.location.href = "index.php?action=GestionIT&click=brand";
                }
            });
        } else if (sup == "category") {
            $.ajax({
                url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionDelete=deleteCategorie&id=${id}&KEY=e8f1997c763`,
                type: "DELETE",
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        alert("Deletion successful!");
                        window.location.href = "index.php?action=GestionIT&click=category";
                    } else {
                        alert("Error during deletion because a product in the store belongs to this category!");

                        window.location.href = "index.php?action=GestionIT&click=category";
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error during deletion because a product in the store belongs to this category!");
                    window.location.href = "index.php?action=GestionIT&click=category";
                }
            });
        } else if (sup == "stock") {
            $.ajax({
                url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionDelete=deleteStock&id=${id}&KEY=e8f1997c763`,
                type: "DELETE",
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        alert("Deletion successful!");
                        window.location.href = "index.php?action=GestionIT&click=stock";
                    } else {
                        alert("Error during deletion.");

                        window.location.href = "index.php?action=GestionIT&click=stock";
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error during deletion.");
                    window.location.href = "index.php?action=GestionIT&click=stock";
                }
            });
        } else if (sup == "store") {
            $.ajax({
                url: `https://bikestoresab.alwaysdata.net/bikestores/api.php?actionDelete=deleteStore&id=${id}&KEY=e8f1997c763`,
                type: "DELETE",
                dataType: "json",
                success: function(data) {
                    if (data.success) {
                        alert("Deletion successful!");
                        window.location.href = "index.php?action=GestionIT&click=store";
                    } else {
                        alert("Error during deletion because there is still stock and employees in the store!");

                        window.location.href = "index.php?action=GestionIT&click=store";
                    }
                },
                error: function(xhr, status, error) {
                    alert("Error during deletion because there is still stock and employees in the store!");
                    window.location.href = "index.php?action=GestionIT&click=store";
                }
            });
        }
    });
</script>