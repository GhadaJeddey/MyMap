"use strict";

//const btnAdd = document.querySelector(".btnAdd");

//btnAdd.addEventListener("click", () => addNoteWithCameraIcon());


function addNoteWithCameraIcon(text = "") {
  const actionsDiv = document.getElementById('noteActions');
  const deleteUrl = actionsDiv.getAttribute('data-delete-url');
  const addUrl = actionsDiv.getAttribute('data-add-url');

  const note = document.createElement("div");
  note.classList.add("note-wrapper");
  note.innerHTML = `
        <form action="${deleteUrl}" method="post" class="delForm">
             <input type="hidden" name="action" value="delete" >
            <input type="hidden" name="noteId" id="delNoteId">
            <button type="button" class="delete" onclick="delNote()"><i class="fas fa-trash-alt"></i> </button>
        </form>
        <form action="${addUrl}" method="post" class="addForm">
            <input type="hidden" name="action" value="add">
            <input type="hidden" name="addNoteText" id="addNoteText">
            <label class="addNote">
                <button id="addNote" onclick="saveNote()"><i class='bx bx-check' style="font-weight: bold; font-size:29px; "></i> </button>
            </label>    
        </form>
        <textarea placeholder='Write something...'>${text}</textarea>`;

  document.body.appendChild(note);
}

function saveNote() {
  const noteText = document.getElementById("noteText").value.trim();
  if (!noteText) {
    alert("Please enter some text to add a note!");
    return;
  }
  const form = document.querySelector(".addForm");
  form.addNoteText.value = noteText;
  form.submit();
}
function delNote() {
  const form = document.querySelector(".delForm");
  form.submit();
}


