<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add/Delete Form Fields</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .field-group {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>

<form id="addpost">
    <div id="field-wrapper">
        <div class="field-group">
            <input type="text" name="post[]" placeholder="Enter post" required />
            <button type="button" class="delete-btn">Delete</button>
        </div>
    </div>
    <button type="button" id="add-btn">Add</button>
    <button type="submit">Submit</button>
</form>

<script>
    $(document).ready(function () {

        // Add new input field
    $('#addpost').on('submit',function (event){


        event.preventDefault();

        jQuery.ajax({

           url:" {url{}} ",
            data:jQuery('#addpost').serializable(),
            type:post,


            success function (result){

            }

        });

    }
    });
});


</script>

</body>
</html>
