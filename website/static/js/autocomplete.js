function filterFunction() {
    let input = document.getElementById("search_box").value.toLowerCase();
    let items = document.querySelectorAll(".autocomplete-items div");

    document.getElementById("autocomplete_list").style.display = "block";

    items.forEach(item => {
        if (item.innerText.toLowerCase().includes(input)) {
            item.style.display = "block";
        } else {
            item.style.display = "none";
        }
    });

    if (input === "") {
        document.getElementById("autocomplete_list").style.display = "none";
    }
}

function selectItem(el) {
    document.getElementById("search_box").value = el.innerText;
    document.getElementById("autocomplete_list").style.display = "none";
}

document.addEventListener("click", function(e) {
    if (!e.target.closest(".autocomplete")) {
        document.getElementById("autocomplete_list").style.display = "none";
    }
});
