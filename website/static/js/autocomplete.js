function filterFunction() {
    let input = document.getElementById("search_box").value.toLowerCase();
    let items = document.querySelectorAll(".autocomplete-items div");
    let hasMatch = false;

    document.getElementById("autocomplete_list").style.display = "block";

    items.forEach(item => {
        let text = item.innerText.toLowerCase();

        if (text.startsWith(input)) {
            item.style.display = "block";
            hasMatch = true;
        } else {
            item.style.display = "none";
        }
    });

    // اگر کلمه‌ای که با ورودی شروع بشه نبود، بگرد کلماتی رو نشون بده که ورودی داخلشونه
    if (!hasMatch) {
        items.forEach(item => {
            if (item.innerText.toLowerCase().includes(input)) {
                item.style.display = "block";
            }
        });
    }

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
