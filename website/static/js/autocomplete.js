function filterFunction() {
    let input = document.getElementById("search_box").value.toLowerCase();
    let items = document.querySelectorAll(".autocomplete-items div");
    let hasMatch = false;
    let executionTimes = [];

    document.getElementById("autocomplete_list").style.display = "block";

    const start = performance.now();

    let count = 0;
    items.forEach(item => {
        let text = item.dataset.term;

        if (count < 25 && text.startsWith(input)) {
            item.classList.remove("hidden");
            hasMatch = true;
            count++;
        } else {
            item.classList.add("hidden");
        }
    });

    // اگر کلمه‌ای که با ورودی شروع بشه نبود، بگرد کلماتی رو نشون بده که ورودی داخلشونه
    if (!hasMatch) {
        items.forEach(item => {
            if (item.dataset.term.includes(input)) {
                item.classList.remove("hidden");
            }
        });
    }

    const end = performance.now();
    const duration = (end-start).toFixed(2);
    executionTimes.push(Number(duration))
    const average = executionTimes.reduce((a, b) => a + b, 0) / executionTimes.length;
    console.log(average.toFixed(2));
    document.getElementById("timeList").innerHTML = executionTimes;

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