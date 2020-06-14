$(function()
{
    alertDestroyProgram();
});

function alertDestroyProgram() {
    $(document).on("click", ".fa-trash", function () {
        alert('本当に消しますか？？？');
    });

}