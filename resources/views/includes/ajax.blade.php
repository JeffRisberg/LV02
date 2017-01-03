<script type="text/javascript">
    /* Sets up the token, put your requests AFTER this section
     */
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajaxPrefilter(function(options, originalOptions, xhr) { // this will run before each request
        var token = $('meta[name="csrf-token"]').attr('content'); // or _token, whichever you are using

        if (token) {
            return xhr.setRequestHeader('X-CSRF-TOKEN', token); // adds directly to the XmlHttpRequest Object
        }
    });
    
    /* Check to see if your element is loaded on the page
     * if( $('#<element id>')[0] ) {  // the [0] is how you can check if it exists
     *      <on ready function>
     * }
     */
    
    $( document ).ready( function() {

        //Friend button on profile page
        if($('#friendButton')[0]) {
           getFriendship(user['id']);
           $('#friendButton').click(function () {
               toggleFriendship(user['id'])
           });
       }
       
       //Block button on profile page
        if($('#blockButton')[0]) {
           //status gets called by getFriendship() above
           $('#blockButton').click(function () {
               toggleBlock(user['id'])
           });
       }
       
       //Address buttons on profile edit page
        if($('#addressEditButton')[0]) {
           //status gets called by getFriendship() above
           $('#addressEditButton').click(function () {
               editAddress()
           });
           $('#addressNewButton').click(function () {
               saveAddress()
           });
       }

    });

    
    /*--------------------------------------------------------------------------
     * Put your event listeners here!
     * 
     */
    
    /*
     * Friends
     */
    function getFriendship(id){
        $.ajax({
            type:'POST',
            dataType:"json",
            url:'/friend/friendship/'+id,
            data:'_token = <?php echo csrf_token() ?>'
        })
        .done( function(data){
            //'friend', 'blocked', 'unfriend', 'accept', 'pending', 'unblock';

            var hide = false;
            if (data == 'blocked') {
                    $('#friendButton').hide();
                    //hide button
            } else if (data == 'unblock') {
                $('#blockButton').text('Unblock');
                $('#blockButton').val('unblock');
                hide = true;
            } else if (data == 'unfriend') {
                $('#friendButton').text('Unfriend');
            } else if (data == 'accept') {
                $('#friendButton').text('Accept friend request');
            } else if (data == 'pending') {
                $('#friendButton').text('Friend request sent');
                $('#friendButton').off("click")
            } else if(data == 'friend') {
                $('#friendButton').text('Send friend request');
                $('#blockButton').text('Block');
                $('#blockButton').val('block');
            } else {
                $('#blockButton').text('Block');
                $('#blockButton').val('block');
            }
            $('#friendButton').val(data);
            if(hide) {
                $('#friendButton').hide();
            } else {
                $('#friendButton').show();
            }
        })
        .fail( function(data) {
            console.log('error');
            $('#friendButton').text('it no worked');
        })
    }
    
    function toggleFriendship(id){
        var url = ($('#friendButton').val() === 'friend') ? 'request/' : 'unfriend/';
        $.ajax({
            type:'POST',
            dataType:"json",
            url:'/friend/'+url+id,
            data:'_token = <?php echo csrf_token() ?>',
            success:function(data){
                getFriendship(id);
            },
            error: function(data) {
                console.log('error');
                $('#friendButton').text('it no worked');
            },
        });
    }
    
    function toggleBlock(id){
        var url = ($('#blockButton').val() === 'block') ? 'block/' : 'unblock/';
        $.ajax({
            type:'POST',
            dataType:"json",
            url:'/friend/'+url+id,
            data:'_token = <?php echo csrf_token() ?>',
            success:function(data){
                getFriendship(id);
            },
            error: function(data) {
                console.log('error:');console.log(data);
                $('#blockButton').text('Block no worked');
            },
        });
    }
    
    /* 
     * Address Editing
     */

    /*  VVV  */
    function vvv_rest(f, req, w) {
        //    f   dynamic callback function
        //    req http request object reference
        //    w   timeout message string (optional)
        if (req.readyState == 4 && req.status == 200)
            f();  //  alert(req.responseText);
        else if (arguments.length > 2)
            alert(w);  //  alert('There was a problem with the request');
        }

    function vvv_vibe(t, i, h, a, e = 'vb') {
        /*    t   content type
        /*    i   content identifier
        /*    h   content handle
        /*    a   action  */
        /*    e   DOM id alternate suffix  */
/*      var url = '/vvv';  */
        var url = '/vvv?t=' + t + '&i=' + i + '&h=' + h + '&a=' + a + '&e=' + e;
    //  alert(url);
        //  DANGER - do not NOT prepend with var, this will persist as global?
        http_req_vb = new XMLHttpRequest();
        http_req_vb.onreadystatechange = function() { vvv_rest(function() {
            document.getElementById(t + '_' + i + '_' + e).innerHTML = http_req_vb.responseText;
        }, http_req_vb); };
        document.getElementById(t + '_' + i + '_' + e).innerHTML = '...';
        http_req_vb.open('GET', url, true);
        http_req_vb.send(null);
    }

    function vocal_toggle(voc_disp, t, i, h, tog = true) {
        /*  For a given message display, reveal/unreveal related comments pane  */
        /*  Upon reveal, trigger AJAX pane content fetch
        /*    t   content type
        /*    i   content identifier
        /*    h   content handle
        /*    tog true, toggle comment pane visible
        /*        false, only refresh pain without changing pane visibility
        /*
        /*    Part of this could be done indirectly with jQuery, 
        /*    $('#' + voc_disp + 'pane').toggle();
        /*    however direct javascript allows launching AJAX pane render upon reveal   */
        var e;
        var refresh = false;

//      alert(voc_disp);
        if (e = document.getElementById(voc_disp + 'pane')) {
            if (tog === false) {
                refresh = true;
            }
            else if (e.style.display == 'none') {
                e.style.display = 'block';
                refresh = true;
            }
            else {
                e.style.display = 'none';
                document.getElementById(voc_pane + 'pane').innerHTML = '...';  /*  'loading' placeholder  */
            }
	}
        if (refresh === true) {
            var url = '/vocal?t=' + t + '&i=' + i + '&h=' + h;
        //  alert('reveal: ' + url);
            //  DANGER - do not NOT prepend with var, this must persist as global?
            http_req_vcpane = new XMLHttpRequest();
            http_req_vcpane.onreadystatechange = function() { vvv_rest(function() {
                e.innerHTML = http_req_vcpane.responseText;
            }, http_req_vcpane); };
            e.innerHTML = '...';  /*  'loading' placeholder  */
            http_req_vcpane.open('GET', url, true);
            http_req_vcpane.send(null);
        }
    }

    function vvv_vocal(t, i, h, m, e = 'vc') {
        /*  For a given message display, add a new comment  */
        /*    t   content type
        /*    i   content identifier
        /*    h   content handle
        /*    m   new comment  */
    //  var url = '/vocal?t=' + t + '&i=' + i + '&h=' + h + '&a=' + a + '&m=' + m + '&e=' + e;
        var url = '/vvv/vocnew?t=' + t + '&i=' + i + '&h=' + h + '&m=' + m + '&e=' + e;
//      alert('vvv_vocal: ' + url);
        //  DANGER - do not NOT prepend with var, this will persist as global?
        http_req_vc = new XMLHttpRequest();
        http_req_vc.onreadystatechange = function() { vvv_rest(function() {
        //  document.getElementById(t + '_' + i + '_' + e + 'pane').innerHTML = http_req_vc.responseText;
            vocal_toggle(t + '_' + i + '_' + e, t, i , h, false);
        }, http_req_vc); };
        document.getElementById(t + '_' + i + '_' + e + 'pane').innerHTML = '...';
        http_req_vc.open('GET', url, true);
        http_req_vc.send(null);
    }

    function vvv_psub(p, a, e = 'pv') {
        /*    p   terse pivot string
        /*    a   action  */
        /*    e   DOM id alternate suffix  */
        var url = '/vvv/psub?p=' + p + '&a=' + a + '&e=' + e;
        http_req_ps = new XMLHttpRequest();
        http_req_ps.onreadystatechange = function() { vvv_rest(function() {
            document.getElementById('sub_' + p + '_' + e).innerHTML = http_req_ps.responseText;
        }, http_req_ps); };
    //  alert(url);
        document.getElementById('sub_' + p + '_' + e).innerHTML = '...';
        http_req_ps.open('GET', url, true);
        http_req_ps.send(null);
    }

</script>
