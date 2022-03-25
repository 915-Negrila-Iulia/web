// Combo Box
var defaultOption = '<option value="city">City</option>'

var clujCities = '<option value="Cluj-Napoca">Cluj-Napoca</option>' +
    '<option value="Turda">Turda</option>' +
    '<option value="Dej">Dej</option>' +
    '<option value="Gherla">Gherla</option>';
var albaCities = '<option value="Alba Iulia">Alba Iulia</option>' +
    '<option value="Aiud">Aiud</option>' +
    '<option value="Blaj">Blaj</option>'
var constantaCities = '<option value="Medgidia">Medgidia</option>' +
    '<option value="Constanta">Constanta</option>' +
    '<option value="Mangalia">Mangalia</option>' +
    '<option value="Cernavoda">Cernavoda</option>';

var timisCities = '<option value="Lugoj">Lugoj</option>' +
    '<option value="Recas">Recas</option>' +
    '<option value="Timisoara">Timisoara</option>';

function filterCities() {
    var countie = document.getElementById("counties").value;

    switch (countie) {
        case "Cluj":
            document.getElementById("cities").innerHTML = defaultOption + clujCities;
            break;
        case "Alba":
            document.getElementById("cities").innerHTML = defaultOption + albaCities;
            break;
        case "Constanta":
            document.getElementById("cities").innerHTML = defaultOption + constantaCities;
            break;
        case "Timis":
            document.getElementById("cities").innerHTML = defaultOption + timisCities;
            break;
        default:
            document.getElementById("cities").innerHTML = defaultOption;
            break;
    }
}


// Drag and Drop
function dropDrag() {
    var dragelem = document.getElementById("drag");
    dragelem.addEventListener("mousedown", elemMouseDown, false);

    function elemMouseDown(ev) {
        ev.preventDefault();
        document.addEventListener("mousemove", elemMouseMove, false);
    }

    function elemMouseMove(ev) {
        var pX = ev.pageX;
        var pY = ev.pageY;
        dragelem.style.left = pX + "px";
        dragelem.style.top = pY + "px";
        document.addEventListener("mouseup", elemMouseUp, false);
    }

    function elemMouseUp() {
        document.removeEventListener("mousemove", elemMouseMove, false);
        document.removeEventListener("mouseup", elemMouseUp, false);
    }
}

// Puzzle
var emptyCell="9";
function loadPuzzle(){
    pics = new Array(10);
    for(i=1; i<10; i++){
        found = true;
        while(found == true){
            x = 1 + Math.floor(Math.random() * 1000) % 9;
            found = false;
            for(j=1; j<i; j++)
                if(pics[j] == x)
                    found = true;
        }
        pics[i] = x;
        if(x==9)
            emptyCell = i;
    }
    var cell;
    for(i=1; i<10; i++){
        cell = document.getElementById(i);
        if(cell){
            img = document.createElement("img");
            if(i!=emptyCell)
                img.setAttribute("src","puzzle/"+pics[i]+".jpg");
            else
                img.setAttribute("src","puzzle/empty.jpg");
            img.style.width = "150px";
            img.style.height = 'auto';
            cell.appendChild(img);
        }
    }
}

function move(cellID,cell){
    //console.log("this=",this,"cell=",cell);
    if(cellID == emptyCell)
        return;
    rest = cellID % 3;
    topPos = (cellID>3) ? cellID-3 : -1;
    bottomPos = (cellID<7) ? cellID+3 : -1;
    leftPos = (rest!=1) ? cellID-1 : -1;
    rightPos = (rest>0) ? cellID+1 : -1;
    if(emptyCell!=topPos && emptyCell!=bottomPos && emptyCell!=leftPos && emptyCell!=rightPos)
        return;

    cell1 = document.getElementById(emptyCell);
    img1 = cell1.firstChild;
    img = cell.firstChild;
    cell.removeChild(cell.firstChild);
    cell1.removeChild(cell1.firstChild);

    cell.appendChild(img1);
    cell1.appendChild(img);
    emptyCell = cellID;
}

// sort table
function sortAscending(table,column){
    var rows = table.rows;
    for(var i=1; i<rows.length-1; i++){
        for(var j=i+1; j<rows.length; j++){
            if(rows[i].getElementsByTagName("td")[column].innerHTML >
                rows[j].getElementsByTagName("td")[column].innerHTML){
                var temp = rows[i].getElementsByTagName("td")[column].innerHTML;
                rows[i].getElementsByTagName("td")[column].innerHTML = rows[j].getElementsByTagName("td")[column].innerHTML;
                rows[j].getElementsByTagName("td")[column].innerHTML = temp;
            }
        }
    }
}

function sortDescending(table,column){
    var rows = table.rows;
    for(var i=1; i<rows.length-1; i++){
        for(var j=i+1; j<rows.length; j++){
            if(rows[i].getElementsByTagName("td")[column].innerHTML <
                rows[j].getElementsByTagName("td")[column].innerHTML){
                var temp = rows[i].getElementsByTagName("td")[column].innerHTML;
                rows[i].getElementsByTagName("td")[column].innerHTML = rows[j].getElementsByTagName("td")[column].innerHTML;
                rows[j].getElementsByTagName("td")[column].innerHTML = temp;
            }
        }
    }
}
var orderArray = [0,0,0];
function sort(column){
    var table = document.getElementById("sort-table");
    if(orderArray[column] == 0){
        sortAscending(table,column);
        orderArray[column] = 1;
    }
    else {
        sortDescending(table, column);
        orderArray[column] = 0;
    }
}

// move item from one list to another
function moveToList(event, listNumber){
    var firstList = document.getElementById("first-list");
    var secondList = document.getElementById("second-list");
    var element = event.target;
    var text = element.innerHTML;
    element.remove();
    if(listNumber == 1){
        newElement = '<li ondblclick="moveToList(event,2)">'+text+'</li>';
        firstList.innerHTML += newElement;
    }
    else{
        newElement = '<li ondblclick="moveToList(event,1)">'+text+'</li>';
        secondList.innerHTML += newElement;
    }
}