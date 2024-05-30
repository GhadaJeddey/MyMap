document.querySelectorAll(".arrow").forEach((arrow) => {
    arrow.addEventListener("click", (e) => {
        let arrowParent = e.target.parentElement.parentElement;
        arrowParent.classList.toggle("showMenu");
    });
});


document.addEventListener('DOMContentLoaded', function() {
    let sidebarBtn = document.querySelector(".bx-menu");
    if (sidebarBtn) {
        sidebarBtn.addEventListener("click", () => {
            let sidebar = document.querySelector(".sidebar");
            sidebar.classList.toggle("close");
        });
    } else {
        console.log("Menu button not found");
    }

    // Ensure this part is corrected
    let arrows = document.querySelectorAll(".arrow");
    arrows.forEach(arrow => {
        arrow.addEventListener("click", (e) => {
            let arrowParent = e.target.parentElement.parentElement; // selecting main parent of arrow
            arrowParent.classList.toggle("showMenu");
        });
    });
});


function logout () {
  window.location.href="{{path('home')}}";
}

function logoutDash () {
    window.location.href="{{path('home')}}";
}

function addTask()
{
  const inputBox=document.getElementById("input-box");
  const listContainer=document.getElementById("list-container");
  let li = document.createElement("li") ;
  li.innerHTML = inputBox.value ; 
  listContainer.appendChild(li);
  let span = document.createElement("span");
  span.innerHTML="\u00d7";
}