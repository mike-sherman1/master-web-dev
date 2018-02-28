$(function() {

    //setup
    var $list; // declare variable
    if(localStorage.getItem('list')) { //restore data from local storage if it exists
        $('ul').html(localStorage.getItem('list'));
        $('h2').html(localStorage.getItem('listTitle'));
    }   
    $list = $('ul'); //cache list as object
    $('li').each(function(i) { //checkbox persistence
        if ($(this).hasClass('completed')) {
            $('input:checkbox').eq(i).attr('checked', true); //if list item comes back from local storage with completed status, check box at this index
        }
    });
    
    //delete item
    $('ul').on('click', 'button', function(e) {
        e.preventDefault();
        $(this).parent().remove(); //remove parent item where X button was clicked
    });

    //checkbox management, toggle completed status
    $('ul').on('click', 'input:checkbox', function(e) {
        var $this = $(this);
        if ($this.is(':checked')) {
            $this.parent().addClass('completed'); //if checked, toggle completed status
        } else {
            $this.parent().removeClass('completed'); //if unchecked, toggle completed status
        }
    });

    //add new item
    $('#new').on('click', function() {
        $list.append('<li><input type="checkbox"><div class="inLine" contenteditable="true">new item</div><button href="#" class="inLine2">X</button></li>'); //append new item to list 
    });

    //save list
    $('#save').on('click', function() {
        var list = $list.html();
        localStorage.setItem('list', list); //store the list html contents
        var listTitle = $('h2').html();
        localStorage.setItem('listTitle', listTitle); //store the list title html contents
    });

    //clear list
    $('#clear').click( function() {
        window.localStorage.clear(); //clear local storage
        location.reload(); //refresh page
        return false;
    });

});