"use strict";

//const btnAdd = document.querySelector(".btnAdd");

//btnAdd.addEventListener("click", () => addNoteWithCameraIcon());

function addNoteWithCameraIcon(text = "") {
  const note = document.createElement("div");
  note.classList.add("note-wrapper");
  note.innerHTML = `
  
  <div class="operations">

  <!-- delete note -->
  <form action="changeNote.php" method="post" id="delForm">
      <input type="hidden" name="action" value="delete" >
      <input type="hidden" name="delNoteText" id="delNoteText">
      <button class="delete" onclick="delNote()"><i class="fas fa-trash-alt"></i> </button>
  </form>

  <!-- add note -->
  <form action="changeNote.php" method="post" id="addForm">
      <input type="hidden" name="action" value="add">
      <input type="hidden" name="addNoteText" id="addNoteText">
      <label class="addNote"> 
          <button id="addNote" onclick="saveNote()"><i class='bx bx-check' style="font-weight: bold; font-size:29px; "></i> </button>
      </label>
  </form> 

  <div class="main ${text ? "" : "hidden"}"></div>
  <textarea placeholder='Write something...' class="${text ? "hidden" : ""}">${text}</textarea>`;

  const editBtn = note.querySelector(".edit");
  const deleteBtn = note.querySelector(".delete");
  const mainEl = note.querySelector(".main");
  const textAreaEl = note.querySelector("textarea");

  textAreaEl.value = text;
  mainEl.innerHTML = text;

  deleteBtn.addEventListener("click", () => {
    note.remove();
  });

  editBtn.addEventListener("click", () => {
    mainEl.classList.toggle("hidden");
    textAreaEl.classList.toggle("hidden");
  });

  textAreaEl.addEventListener("input", (e) => {
    const { value } = e.target;
    mainEl.innerHTML = value;
  });

  document.body.appendChild(note);
}


function saveNote() {
  const noteText = document.getElementById("noteText").value;
  if (!noteText) {
    alert("areatextempty!");
    return; 
  }
  document.getElementById("addNoteText").value = noteText;
  document.getElementById("addForm").submit();

}

function editNote() {

  
  const noteText = document.getElementById("noteText").value;
  if (!noteText) {
      alert("Please enter a note before submitting!");
      return; 
  }
  var editNoteText = document.getElementById("editNoteText");
  editNoteText.value = noteText;
  var editForm = document.getElementById('editForm');
  editForm.submit();

}

function delNote() {
  const noteText = document.getElementById("noteText").value;

  var delNoteText = document.getElementById("delNoteText");
  delNoteText.value = noteText;
  var delForm = document.getElementById('delForm');
  delForm.submit();
  
}

