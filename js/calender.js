const calendar= document.getElementById("calendar");
const monthYear= document.getElementById("monthYear");
const now = new Date();
const year = now.getFullYear();
const month = now.getMonth();
const today = now.getDate();
const monthNames = ["Januar","Februar","März","April","Mai","Juni",
"Juli","August","September","Oktober","November","Dezember"];
const dayNames = ["Mo","Di","Mi","Do","Fr","Sa","So"];
monthYear.textContent = `${monthNames[month]} ${year}`;
dayNames.forEach(day => {
 const dayElem = document.createElement("div");
 dayElem.className = "day header";
 dayElem.textContent = day;
 calendar.appendChild(dayElem);
});
const firstDay = new Date(year, month, 1).getDay();
const offset = (firstDay + 6) % 7;
for (let i = 0; i < offset; i++) {
 calendar.appendChild(document.createElement("div"));
}
const daysInMonth = new Date(year, month + 1, 0).getDate();
for (let d = 1; d <= daysInMonth; d++) {
 const dayElem = document.createElement("div");
 dayElem.className = "day";
 dayElem.textContent = d;
 if (d === today) {
   dayElem.classList.add("today");
 }
 calendar.appendChild(dayElem);
}


