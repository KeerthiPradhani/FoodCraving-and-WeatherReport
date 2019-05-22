<?php

    /**
     * Provides some session management functionality.
     */


    // Always needed for session functionality!
    session_start();

    /**
     * Starts a session for the supplied username.
     *
     * @param string the username which owns the session
     */
    function startSession($username) {
        // Set the session variables accordingly
        $_SESSION['LOGGEDIN'] = true;
        $_SESSION['USERNAME'] = $username;
    }

    /**
     * Terminates the current session.
     */
    function destroySession() {
        // Set the session variables accordingly
        $_SESSION['LOGGEDIN'] = false;
        $_SESSION['USERNAME'] = null;

        // Destroy the session
        session_destroy();
    }

    /**
     * Determines if a session exists currently.
     *
     * @return boolean true if a session exists, false otherwise
     */
    function hasSession() {
        return true == $_SESSION['LOGGEDIN'];
    }

    /**
     * Gets the username for the current session.
     *
     * @return string the username for the current session
     */
    function getUsername() {
        return $_SESSION['USERNAME'];
    }

?>
