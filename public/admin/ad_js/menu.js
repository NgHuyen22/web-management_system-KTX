

document.addEventListener("DOMContentLoaded", function (event) {
    const showNavbar = (toggleId, navId, bodyId, headerId) => {
        const toggle = document.getElementById(toggleId),
            nav = document.getElementById(navId),
            bodypd = document.getElementById(bodyId),
            headerpd = document.getElementById(headerId)
    
        // Validate that all variables exist
        if (toggle && nav && bodypd && headerpd) {
            toggle.addEventListener('click', () => {
                // show navbar
                nav.classList.toggle('show')
                // change icon
                toggle.classList.toggle('bx-x')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')
            })
        }
    }
    
    showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')
    
    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')
    
    function colorLink() {
        if (linkColor) {
            linkColor.forEach(l => l.classList.remove('active'))
            this.classList.add('active')
    
            // Assuming you want to send data to a PHP script when a link is clicked
            const selectedLinkId = this.getAttribute('data-link-id');
    
            // Make an AJAX request to a PHP script
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'your_php_script.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    // Handle the response from the PHP script if needed
                    console.log(xhr.responseText);
                }
            };
            xhr.send('linkId=' + encodeURIComponent(selectedLinkId));
        }
    }
    linkColor.forEach(l => l.addEventListener('click', colorLink));
    
    // Your code to run since DOM is loaded and ready
    });
    
    
    