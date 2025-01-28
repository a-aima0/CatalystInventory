function script(){
    this.initialize = function(){
        this.registerEvents();
    }
    this.registerEvents = function(){

        document.addEventListener('click', function (e) {
            let targetElement = e.target;
            let classList = targetElement.classList;

            if (classList.contains("deleteUser")) {
                e.preventDefault();
                let userId = targetElement.dataset.userid;
                let fname = targetElement.dataset.fname;
                let lname = targetElement.dataset.lname;
                let fullName = fname + " " + lname;

                if (window.confirm("Are you sure you want to delete " + fullName + "?")) {
                    console.log("Starting AJAX request to delete user:", userId);

                    $.ajax({
                        method: "POST",
                        data: {
                            user_id: userId,
                            f_name: fname,
                            l_name: lname
                        },
                        url: "../php/deleteUser.php",
                        dataType: 'json',
                        success: function (data) {
                            console.log("AJAX success response:", data);

                            if (data.success) {
                                alert(data.message);
                                location.reload();
                            } else {
                                alert("Failed to delete user: " + data.message);
                            }
                        },

                        error: function (xhr, status, error) {
                            console.error("AJAX error:", status, error);
                            console.error("Response:", xhr.responseText);
                            alert("An error occurred: " + xhr.responseText);
                        }
                    });
                }
            }
        });

    // });
    }
}

var script = new script;
script.initialize();