
document.querySelectorAll('svg path').forEach(function(countryPath) {
    countryPath.addEventListener('click', function() {
        showPopup(this);
    });
});

function showPopup(pathElement) {
    const countryName = getCountryNameFromPath(pathElement);
    document.getElementById("Popup").style.display = "block";
    document.getElementById("country").children[0].textContent =countryName.replace(/_/g, " ");
    document.getElementById("Popup").classList.remove("hidden");
    document.getElementById("countryNameInput").value= countryName;
    document.getElementById("countryNameInputt").value= countryName;

    document.getElementById("visited").setAttribute('data-addedCountry-id', countryName); 
    document.getElementById("removed").setAttribute('data-removedCountry-id',countryName);
    
}

function getCountryNameFromPath(pathElement) {
    let countryName = "";
for (const className of pathElement.classList) {
        countryName += className + " "; 
    }
    return countryName.trim(); 
}

function confirmVisit(isVisited) {
    const countryId = document.getElementById("visited").getAttribute('data-addedCountry-id');
    console.log(countryId);
    if (countryId && isVisited) {
            document.querySelectorAll(`.${countryId}`).forEach(function(path) {
                path.style.fill = "#99E2B4"; 
            });
    }

    document.getElementById("Popup").style.display = "none";
    var visitForm = document.getElementById("visitForm");
    visitForm.submit();
    return false; 
}

function removeVisit(isRemoved)
{
    const countryId = document.getElementById("removed").getAttribute('data-removedCountry-id');
    console.log("from removeVisit : " +document.getElementById("countryNameInputt").value);

    if (countryId && isRemoved) {
            document.querySelectorAll(`.${countryId}`).forEach(function(path) {
                path.style.fill = "#56AB91"; 
            });
    }

    document.getElementById("Popup").style.display = "none";
    var removeForm = document.getElementById("removeForm");
    removeForm.submit();
    return false ; 
}

function logout()
{
    window.location.href="logout.php";  
}