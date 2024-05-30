"use strict";

function addNoteWithCameraIcon(note) {
  const actionsDiv = document.getElementById('noteActions');
  const deleteUrl = actionsDiv.getAttribute('data-delete-url');
  const addUrl = actionsDiv.getAttribute('data-add-url');

  const noteWrapper = document.createElement("div");
  noteWrapper.classList.add("note-wrapper");
  noteWrapper.innerHTML = `
        <form action="${deleteUrl}" method="post" class="delForm">
            <input type="hidden" name="noteId" value="${note.id}">
            <button type="button" class="delete" onclick="delNote()"><i class="fas fa-trash-alt"></i></button>
        </form>
        <form action="${addUrl}" method="post" class="addForm">
            <input type="hidden" name="noteText" id="noteText_${note.id}" value="${note.content}">
            <label class="addNote">
                <button type="button" onclick="saveNote()">
                    <i class='bx bx-check' style="font-weight: bold; font-size: 29px;"></i>
                </button>
            </label>
        </form>
        <textarea placeholder='Write something...' id="noteTextarea_${note.id}" oninput="updateNoteText(${note.id})">${note.content}</textarea>`;

  document.getElementById('notesContainer').appendChild(noteWrapper);
}

function updateNoteText(noteId) {
  const textarea = document.getElementById(`noteTextarea_${noteId}`);
  const hiddenInput = document.getElementById(`noteText_${noteId}`);
  hiddenInput.value = textarea.value.trim();
}

function saveNote() {
  const noteText = document.getElementById("noteText").value.trim();
  if (!noteText) {
    alert("Please enter some text to add a note!");
    return;
  }
  const form = document.getElementById("addForm");
  document.getElementById("noteTextInput").value = noteText;
  form.submit();
}

function delNote() {
  const form = document.querySelector(".delForm");
  form.submit();
}

