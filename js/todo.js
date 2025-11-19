// Aufgaben laden
   function ladeTodos() {
     fetch("api.php")
       .then(res => res.text())
       .then(html => {
         document.getElementById("liste").innerHTML = html;
       });
   }
   // Neue Aufgabe hinzufügen
   function addTodo() {
     const input = document.getElementById("input");
     const text = input.value.trim();
     if (text !== "") {
       const formData = new FormData();
       formData.append("todo", text);
       fetch("api.php", {
         method: "POST",
         body: formData
       })
       .then(res => res.text())
       .then(data => {
         if (data === "OK") {
           input.value = "";
           ladeTodos();
         } else {
           alert("Fehler: " + data);
         }
       });
     }
   }

/*function addTodo() {
  const input = document.getElementById("input");
  const text = input.value.trim();
  if (text !== "") {
    const formData = new FormData();
    formData.append("todo", text);

    fetch("api.php", {
      method: "POST",
      body: formData
    })
    .then(res => res.json())
    .then(data => {
      if (data.status === "OK") {
        input.value = "";

        // Neue To-Do direkt anzeigen mit Zeit
        const li = document.createElement("li");
        li.innerHTML = `${data.text} <span class="timestamp">(${data.timestamp})</span>`;
        document.getElementById("liste").appendChild(li);
      } else {
        alert("Fehler: " + data);
      }
    })
    .catch(err => {
      alert("Serverfehler: " + err);
    });
  }
}*/



   // Aufgabe löschen
   function deleteTodo(id) {
     const formData = new FormData();
     formData.append("delete_id", id);
     fetch("api.php", {
       method: "POST",
       body: formData
     })
     .then(res => res.text())
     .then(data => {
       if (data === "OK") {
         ladeTodos();
       } else {
         alert("Fehler: " + data);
       }
     });
   }
   // Beim Laden der Seite Todos holen
   window.onload = ladeTodos;