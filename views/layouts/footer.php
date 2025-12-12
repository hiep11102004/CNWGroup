<?php

?>

<footer>
    <div class="container">
        <p>&copy; <?php echo date("Y"); ?> Online Course Management System. All rights reserved.</p>
        <ul>
            <li><a href="/about">About Us</a></li>
            <li><a href="/contact">Contact</a></li>
            <li><a href="/privacy">Privacy Policy</a></li>
            <li><a href="/terms">Terms of Service</a></li>
        </ul>
    </div>
</footer>

<style>
    footer {
        background-color: #f8f9fa;
        padding: 20px 0;
        text-align: center;
        position: relative;
        bottom: 0;
        width: 100%;
    }

    footer p {
        margin: 0;
        color: #6c757d;
    }

    footer ul {
        list-style: none;
        padding: 0;
    }

    footer ul li {
        display: inline;
        margin: 0 15px;
    }

    footer ul li a {
        text-decoration: none;
        color: #007bff;
    }

    footer ul li a:hover {
        text-decoration: underline;
    }
</style>