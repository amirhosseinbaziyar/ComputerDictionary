let executionTimes = [];

function filterFunction() {
    let startTime = performance.now();  // شروع زمان‌گیری

    let input = document.getElementById("search_box").value.toLowerCase();
    let autocompleteList = document.getElementById("autocomplete_list");

    // پاک کردن پیشنهادات قبلی
    autocompleteList.innerHTML = "";

    if (!input) {
        autocompleteList.style.display = "none";
        return;
    }

    let filteredTerms = terms
        .filter(t => t.term.startsWith(input))
        .slice(0, 25);

    if (filteredTerms.length === 0) {
        filteredTerms = terms.filter(t => t.term.includes(input)).slice(0, 25);
    }

    filteredTerms.forEach(t => {
        let div = document.createElement("div");
        div.innerText = t.display;
        div.dataset.term = t.term;
        div.onclick = function () {
            selectItem(this);
        };
        autocompleteList.appendChild(div);
    });

    autocompleteList.style.display = "block";

    let endTime = performance.now();  // پایان زمان‌گیری
    let executionTime = (endTime - startTime).toFixed(3);
    console.log(`filterFunction اجرا شد در: ${executionTime} میلی‌ثانیه`);
    executionTimes.push(parseFloat(executionTime));
    let averageTime = (executionTimes.reduce((a, b) => a + b, 0) / executionTimes.length).toFixed(3);
    let minTime = Math.min(...executionTimes).toFixed(3);
    let maxTime = Math.max(...executionTimes).toFixed(3);
    let countTimes = executionTimes.length; // تعداد زمان‌های ثبت‌شده
    document.getElementById("timeList").innerText = `میانگین: ${averageTime} ms | کمترین: ${minTime} ms | بیشترین: ${maxTime} ms | تعداد: ${countTimes}`;
}
