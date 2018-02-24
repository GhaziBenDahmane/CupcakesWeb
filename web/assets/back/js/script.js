$("#CSubmit").click(function(){

    axios.post('admin/contact/new', {
        firstName: $("#CFirstName").val(),
        email: $("#CEmail").val(),
        message: $("#CMsg").val(),
        tel: $("#CTel").val(),
        ajax: "true"

    })
        .then(function (response) {
            $("#CFirstName").val("");
            $("#CEmail").val("");
            $("#CMsg").val("");
            $("#CTel").val("");
            $('.alert').append(' ' +
                ' <strong>successful!</strong>  ');

            $('.alert').attr("class","alert alert-success");

        })
        .catch(function (error) {
            $('.alert').append(' ' +
                ' <strong>error!</strong>  ');

            $('.alert').attr("class","alert alert-danger");
        });
});


function DeleteUser(id) {
    var conf = confirm("Are you sure, do you really want to delete Contact?");
    if (conf == true) {
        $.post("ajax/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
            }
        );
    }
}

function GetUserDetails(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("ajax/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_first_name").val(user.first_name);
            $("#update_last_name").val(user.last_name);
            $("#update_email").val(user.email);
        }
    );
    // Open modal popup
    $("#update_user_modal").modal("show");
}

function UpdateUserDetails() {
    // get values
    var first_name = $("#update_first_name").val();
    var last_name = $("#update_last_name").val();
    var email = $("#update_email").val();

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("ajax/updateUserDetails.php", {
            id: id,
            first_name: first_name,
            last_name: last_name,
            email: email
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); // calling function
});