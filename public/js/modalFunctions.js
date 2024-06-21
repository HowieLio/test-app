    function toggleModal(modalId, action) {
        var modal = document.getElementById(modalId);
        var addBlock = document.getElementById('add-block'); // Предположим, что addBlock нужен только для модального окна 'myModal'

        if (action === 'open') {
            modal.style.display = 'flex';
            if (modalId === 'myModal') {
                addBlock.style.display = 'block';
            }
        } else if (action === 'close') {
            modal.style.display = 'none';
            if (modalId === 'myModal') {
                addBlock.style.display = 'none';
            }
        }
    }
    function handleAddButton() {
        toggleModal('myModal', 'open');
    }
    function closeAddModal() {
        toggleModal('myModal', 'close');
    }
    function handleEditButton() {
        toggleModal('editModal', 'open');
    }
    function closeEditModal() {
        toggleModal('editModal', 'close');
    }
    function closeInfoModal() {
        toggleModal('infoModal', 'close');
    }
