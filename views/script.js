let granTotal = 0;  // Variable para almacenar el total general

document.getElementById('formBusqueda').addEventListener('submit', function(event) {
    event.preventDefault();
    const codigoBarras = document.getElementById('codigo').value;

    // Hacer una solicitud AJAX para obtener los datos del producto por el código de barras
    fetch('agregarAlCarrito.php?codigo=' + codigoBarras)
        .then(response => response.json())
        .then(data => {
            if (data !== null) {
                // Actualizar la tabla con los datos obtenidos
                const tableBody = document.getElementById('resultadoBusqueda');
                const newRow = tableBody.insertRow(tableBody.rows.length);
                newRow.innerHTML = `
                    <td>${data.codigo}</td>
                    <td>${data.producto}</td>
                    <td>${data.existencia}</td>
                    <td>${data.venta}</td>
                    <td><input type="number" id="cantidadVendida" value="0" min="0" onchange="calcularTotal(this)"></td>
                    
                    <td><button onclick="removeRow(this)">Quitar</button></td>
                    <td>$0.00</td>
                `;
            } else {
                alert("Producto no encontrado.");
            }
        })
        .catch(error => console.error('Error:', error));
});

function calcularTotal(input) {
    const cantidad = parseInt(input.value, 10);
    const venta = parseFloat(input.parentNode.previousElementSibling.innerText);
    const total = cantidad * venta;
    const row = input.parentNode.parentNode;
    row.lastElementChild.innerText = `$${total.toFixed(2)}`;
    
    // Actualizar el gran total
    granTotal += total;
    document.getElementById('granTotal').innerText = granTotal.toFixed(2);
}


function removeRow(button) {
    const row = button.parentNode.parentNode;
    const totalRow = parseFloat(row.lastElementChild.innerText.substring(1));
    
    // Restar el total de la fila eliminada del gran total
    granTotal -= totalRow;
    document.getElementById('granTotal').innerText = granTotal.toFixed(2);
    
    row.parentNode.removeChild(row);
}
