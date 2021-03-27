(function () {
    $(document).ready(function () {

        //CK Editor
        CKEDITOR.replace('post_editor');
        CKEDITOR.replace('post_editor_edit')

        CKEDITOR.replace('testimonial_editor');
        CKEDITOR.replace('product_editor');


        //Data Table
        $('table.data-table').DataTable();

        // Logout System
        $('a#logout-button').click(function (e) {
            e.preventDefault();              //will not go to the other page or stay same page after clicking or return false/ or the page will not relaod
            alert('test purpose');

            $('form#logout-form').submit();  //logout form will be submit through logout-form

        });


        //Category Edit

        $(document).on('click', 'a#category_edit',function (e) {
            e.preventDefault();
            let id = $(this).attr('edit_id');       //alert(id);

            //we want to receive data under id
            $.ajax({
                url : "post-category-edit/" + id,       //route name  // has to make a route and route will get route
                dataType : "json",
                success : function(data) {
                      // alert(data.name + data.id);
                    $('#category_modal_update form input[name="name"]').val(data.name);
                    $('#category_modal_update form input[name="id"]').val(data.id);

                }

            });

        });

          //Product Image Load
        $(document).on('change','input#pimage',  function (event) {
              event.preventDefault();
              //alert('test');
              let product_image_url = URL.createObjectURL(event.target.files[0]);  //alert(product_image_load);
              $('img#product_image_load').attr('src', product_image_url );

        });


        //Post Featured Image Load
        $(document).on('change', "input#fimage",function(event){
            event.preventDefault();   //no more forward

            //alert('test purpose');

            let  post_image_url = URL.createObjectURL(event.target.files[0]);  //here URL is a object of javaScript and called a function named is  createObjectURL()

            $('img#post_featured_image_load').attr('src',post_image_url)

        });

        //Testimonial Image Load
        $(document).on('change', "input#testimonal_image", function (event) {
            event.preventDefault();
            let testimonial_image_url = URL.createObjectURL(event.target.files[0]);           //alert(testimonial_image_url);
            $('img#testimonial_image_load').attr('src', testimonial_image_url);

        });

        //Slider Post Image Load
        $(document).on('change', "input#slide_image", function (event) {
            event.preventDefault();                                                           // alert('test purpose');

            let post_slide_image_url = URL.createObjectURL(event.target.files[0]);            // alert('image url :'+post_slide_image_url);

            $('img#post_slide_image_load').attr('src',post_slide_image_url)
        });



        //Post Featured Image Load for Edit
        $(document).on('change', "input#fimage-edit",function(event){
            event.preventDefault();   //no more forward

            //alert('test purpose');

            let  post_image_url = URL.createObjectURL(event.target.files[0]);  //here URL is a object of javaScript and called a function named is  createObjectURL()

            $('img#post_featured_image_edit').attr('src',post_image_url)

        });


        //Post Edit

        $(document).on('click', '#post_edit',function (e) {
           e.preventDefault();

          let edit_id = $(this).attr('edit_id');

         // alert(edit_id);

              $.ajax({
               url : 'post-edit/' + edit_id,
                 success : function (data) {
                  // alert(data.title);

                   $('#post_modal_update input[name="id"]').val(data.id);
                   $('#post_modal_update input[name="title"]').val(data.title);
                   $('#post_modal_update textarea').text(data.content);                         //alert(data.content);

                   $('#post_featured_image_edit').attr('src', 'media/posts/'+ data.image);     alert(data.image);
                   $('#post_modal_update .cl').html(data.cat_list);

                   $('#post_modal_update').modal('show');




                    // $('#post_modal_update input[name="title"]').val(data.title);
                   // $('#post_featured_image_edit').attr('src', 'media/posts/' + data.image);   // alert(data.featured_image);
                   // $('#post_modal_update .cl').html(data.cat_list);
                   //
                  // $('#post_modal_update').modal('show');

                  // alert(data.image);
                   //
                   //  alert(data.cat.name);

               }

           });


        });


        //----------------Slider Information Update--------------------

        $(document).on('click', '#slide_edit',function (e) {
            e.preventDefault();

            let edit_id = $(this).attr('edit_id');

            // alert(' Edit ID : '+edit_id);

            $.ajax({
                url : 'slide-edit/' + edit_id,
                success : function (data) {

                    // all value will show after returing from edit function with id and Page is SliderPostController.php
                    // alert(data.title);

                    $('#slide_modal_update input[name="id"]').val(data.id);                        //  alert(data.id);

                    $('#slide_modal_update input[name="title"]').val(data.title);                  //  alert(data.title);

                    $('#slide_modal_update input[name="sliders"]').val(data.sliders);              //   alert(data.sliders);

                    $('#slide_featured_image_edit').attr('src', 'media/sliders/'+ data.image);   // alert(data.image);

                    //$('#slide_modal_update .cl').html(data.cat_list);

                    $('#slide_modal_update').modal('show');

                }

            });


        });

        // Slider Image Load for Edit
        $(document).on('change', "input#slide-image-edit",function(event){
            event.preventDefault();   //no more forward

            //alert('test purpose');

            let  post_image_url = URL.createObjectURL(event.target.files[0]);  //here URL is a object of javaScript and called a function named is  createObjectURL()

            $('img#slide_featured_image_edit').attr('src',post_image_url)

        });




        //Comet Slider Script
        $(document).on('click', '#comet-add-slide', function () {

            let rand = Math.floor(Math.random() * 1000);

            $('.comet-slider-container').append('<div id="slider-card-' + rand + '" class="card"><div data-toggle="collapse" data-target="#slide-' + rand + '" style="cursor: pointer" class="card-header"><h4>#Slide - ' + rand +' <button id="comet-slide-remove-btn" remove_id="' + rand + '" class="close">&times;</button></h4></div><div id="slide-' + rand + '" class="collapse"><div class="card-body"><div class="form-group"><label for="">Sub Title</label><input type="hidden" name="slide_code[]" value="'+ rand +'" class="form-control"><input type="text" name="subtitle[]" class="form-control"></div><div class="form-group"><label for="">Title</label><input type="text" name="title[]" class="form-control"></div><div class="form-group"><label for="">Button 01 Title </label><input type="text" name="btn1_title[]" class="form-control"></div><div class="form-group"><label for="">Button 01 Link </label><input type="text" name="btn1_link[]" class="form-control"></div><div class="form-group"><label for="">Button 02 Title </label><input type="text" name="btn2_title[]"  class="form-control"></div><div class="form-group"><label for="">Button 02 Link </label><input type="text" name="btn2_link[]"  class="form-control"></div></div></div></div>');

             return false;
        });

        //Testimonial or Selected Work Script
        $(document).on('click', '#comet-add-testimonial', function () {
            let rand = Math.floor(Math.random()*1000);
            $('.comet-testimonial-container').append('<div id="slider-card-' + rand + '" class="card">' +
                '<div data-toggle="collapse" data-target="#slide-' + rand + '" style="cursor: pointer" class="card-header"><h4>#Testimonial - ' + rand +' <button id="comet-testimonial-remove-btn" remove_id="' + rand + '" class="close">&times;</button></h4></div>' +
                '<div id="slide-' + rand + '" class="collapse">' +
                '<div class="card-body">' +
                '<div class="form-group"><label for="">Title</label><input type="text" name="title[]" class="form-control"><input type="text" name="testimonial_code[]" value="'+ rand +'" class="form-control"></div>' +
                '<div class="form-group"><label for="">Sub Title</label><input type="text" name="subtitle[]" class="form-control"></div>' +
                '<div class="form-group"><label for="">More info </label><input type="text" name="more_info[]" class="form-control"></div>' +
                '</div>' +
                '</div>' +
                '</div>');

                 return false;

        });

           //  $('.comet-slider-container').append('<div id="slider-card-' + rand +'" class="card"> \n'  +
           //      '<div data-toggle="collapse" data-target="#slide-' + rand +'" style="cursor: pointer" class="card-header"><h4>#Slide 1 <button id="comet-slide-remove-btn" remove_id="' + rand +'" class="close">&times;</button></h4></div>\n' +
           //          '<div id="slide-' + rand +'" class="collapse">\n'+
           //              '<div class="card-body">\n' +
           //                '<div class="form-group">\n' +
           //                  '<label for="">Sub Title</label>\n'+
           //                  '<input type="text" class="form-control">\n'+
           //                '</div>\n'+
           //              '</div>\n'   +
           //          '</div>\n'  +
           //         '</div>\n');
           //
           //     return false;
           // });






       //Slider Remove
        $(document).on('click', '#comet-slide-remove-btn', function () {
            let remove_code = $(this).attr('remove_id');
           // alert(remove_code);
            $('#slider-card-'+remove_code).remove();
            return false;

        });



        //Testimonial Remove

        $(document).on('click', '#comet-testimonial-remove-btn',function () {

            let remove_code = $(this).attr('remove_id');

           // alert(remove_code);

            $('#slider-card-'+remove_code).remove();

            return false;

        });


        //Comet Dynamic Slider Script - 23-01-2021
        $(document).on('click', '#comet-single-add-slide', function () {

            let rand = Math.floor(Math.random() * 1000);

            $('.comet-dynamic-slider-container').append('<div id="slider-card-' + rand + '" class="card"><div data-toggle="collapse" data-target="#slide-' + rand + '" style="cursor: pointer" class="card-header"><h4>#Slide - ' + rand +' <button id="comet-slide-remove-btn" remove_id="' + rand + '" class="close">&times;</button></h4></div><div id="slide-' + rand + '" class="collapse"><div class="card-body"><div class="form-group"><label for="">Sub Title</label><input type="hidden" name="slide_code[]" value="'+ rand +'" class="form-control"><input type="text" name="subtitle[]" class="form-control"></div><div class="form-group"><label for="">Title</label><input type="text" name="title[]" class="form-control"></div><div class="form-group"><label for="">Button 01 Title </label><input type="text" name="btn1_title[]" class="form-control"></div><div class="form-group"><label for="">Button 01 Link </label><input type="text" name="btn1_link[]" class="form-control"></div><div class="form-group"><label for="">Button 02 Title </label><input type="text" name="btn2_title[]"  class="form-control"></div><div class="form-group"><label for="">Button 02 Link </label><input type="text" name="btn2_link[]"  class="form-control"></div></div></div></div>');

            return false;
        });












































    });
})(jQuery)