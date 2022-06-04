const button = document.querySelector('button');
const rangeFrom = document.getElementById('range-from');
const rangeTo = document.getElementById('range-to');

const listRange = document.getElementById('list-range');
const storage = window.localStorage;

const checkStorage = function() {
    if (storage.getItem('from')) document.getElementById('from-list').innerHTML = `<option value="${storage.getItem('from')}"></option>`;
    if (storage.getItem('to')) document.getElementById('to-list').innerHTML = `<option value="${storage.getItem('to')}"></option>`;
}

checkStorage();

button.onclick = async function() {
    if (rangeFrom.value.trim() == '' || 
        rangeTo.value.trim() == '' || 
        isNaN(rangeTo.value) || 
        isNaN(rangeFrom.value)) return;
    
    storage.setItem('from', rangeFrom.value)
    storage.setItem('to', rangeTo.value)

    checkStorage();
    await send({ 'event': 'range', 'from': rangeFrom.value, 'to': rangeTo.value }, true)
    .then(value => listRange.innerHTML = value);
}

const send = async function(data) {
    return await fetch('/controllers/controller.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then((response) => { 
        return response.json()
    });
}