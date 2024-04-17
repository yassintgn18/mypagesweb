let availablekeywords = [
    'basketball',
    'hand',
    'golf',
    'ping pong',
    'footbal',
    'tennis',
    'volley',
    'la tante',
    'backpack',
    'mindar',
    '9r3a',
    '9r3a',
    'KORSI',
];

const resultBox = document.querySelector(".result-box");
const inpuBox = document.getElementById("input-box");

inpuBox.onkeyup = function () {
    let result = [];
    let input = inpuBox.value;
    if (input.length) {
        result = availablekeywords.filter((keyword) => {
            return keyword.toLowerCase().includes(input.toLowerCase());
        });
        display(result);
        if(!result.length){
            resultBox.innerHTML = '';
        }
    }
}

function display(result) {
    const content = result.map((list) => {
        return "<li onclick=selectInput(list)>" + list + "</li>";
    }).join(""); // Use join("") to convert array to string
    resultBox.innerHTML = "<ul>" + content + "</ul>";
}

function selectInput(list){
    inpuBox.value = list.innerHTML;   
    resultBox.innerHTML = "";
}