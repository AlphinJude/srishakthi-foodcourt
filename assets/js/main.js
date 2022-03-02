function addNewItems() {
    document.getElementById("add-items").style.display = "block";
}

function closeAddItems() {
    document.getElementById("add-items").style.display = "none";
}

function addItemRow(){
    $("<tbody>").load("add-item.php", function() {
        $("#add-item-table").append($(this).html());
    });	
}

function displaySettings() {
    var x = document.getElementById("settings");

    if (x.style.display === "flex") {
        x.style.display = "none";
    } else {
        x.style.display = "flex";
    }
}