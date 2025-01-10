function confirmDelete(id) {
    return confirm(`¿Estás seguro de que deseas borrar el usuario con ID ${id}?`);
}
document.addEventListener('DOMContentLoaded', function () {
    var toastElList = [].slice.call(document.querySelectorAll('.toast'))
    var toastList = toastElList.map(function (toastEl) {
        return new bootstrap.Toast(toastEl)
    })
    toastList.forEach(toast => toast.show())
});
