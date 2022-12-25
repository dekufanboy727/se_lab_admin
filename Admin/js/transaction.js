function performSearch() {
    const searchBar = document.getElementById('searchBar');
    const table = document.getElementById("transactionTable");
    const trs = table.tBodies[0].getElementsByTagName("tr");

    var filter = searchBar.value.toUpperCase();

    for (var rowI = 0; rowI < trs.length; rowI++) {
        var tds = trs[rowI].getElementsByTagName("td");
        trs[rowI].style.display = "none";

        for (var cellI = 0; cellI < tds.length; cellI++) {
            if (tds[cellI].innerHTML.toUpperCase().indexOf(filter) > -1) {
                trs[rowI].style.display = "";
                continue;
            }
        }
    }
}

function sortByAlphabet(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

    table = document.getElementById("transactionTable");

    switching = true;

    dir = "asc"; 

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;

            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            if (dir == "asc") {
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                shouldSwitch= true;
                break;
                }
            } else if (dir == "desc") {
                if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                shouldSwitch = true;
                break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;      
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

function sortByInt(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

    table = document.getElementById("transactionTable");

    switching = true;

    dir = "asc"; 

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;

            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            var compareX = isNaN(parseInt(x.innerHTML))?x.innerHTML.toLowerCase():parseInt(x.innerHTML);
            var compareY = isNaN(parseInt(y.innerHTML))?y.innerHTML.toLowerCase():parseInt(y.innerHTML);

            compareX=(compareX=='-')?0:compareX;
            compareY=(compareY=='-')?0:compareY;

            if (dir == "asc") {
                if (compareX > compareY) {
                shouldSwitch= true;
                break;
                }
            } else if (dir == "desc") {
                if (compareX < compareY) {
                shouldSwitch = true;
                break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;      
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}

function sortByFloat(n) {
    var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;

    table = document.getElementById("transactionTable");

    switching = true;

    dir = "asc"; 

    while (switching) {
        switching = false;
        rows = table.rows;

        for (i = 1; i < (rows.length - 1); i++) {
            shouldSwitch = false;

            x = rows[i].getElementsByTagName("TD")[n];
            y = rows[i + 1].getElementsByTagName("TD")[n];

            var compareX = isNaN(parseFloat(x.innerHTML))?x.innerHTML.toLowerCase():parseFloat(x.innerHTML);
            var compareY = isNaN(parseFloat(y.innerHTML))?y.innerHTML.toLowerCase():parseFloat(y.innerHTML);

            compareX=(compareX=='-')?0:compareX;
            compareY=(compareY=='-')?0:compareY;

            if (dir == "asc") {
                if (compareX > compareY) {
                shouldSwitch= true;
                break;
                }
            } else if (dir == "desc") {
                if (compareX < compareY) {
                shouldSwitch = true;
                break;
                }
            }
        }
        if (shouldSwitch) {
            rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
            switching = true;
            switchcount ++;      
        } else {
            if (switchcount == 0 && dir == "asc") {
                dir = "desc";
                switching = true;
            }
        }
    }
}