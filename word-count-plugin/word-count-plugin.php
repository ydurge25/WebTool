<?php
/*
Plugin Name: Word, Character, and Text Transformation Plugin
Description: A plugin that allows users to count words, count characters, and transform text to uppercase, lowercase, and capitalized forms.
Version: 1.3
Author: Your Name
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Word Count Function
function wcp_count_words($atts) {
    if (isset($_POST['wcp_submit'])) {
        $text = sanitize_textarea_field($_POST['wcp_text']);
        $text = wp_strip_all_tags($text);
        $word_count = str_word_count($text);
        $result = "<p>Word count: " . $word_count . "</p>";
    } else {
        $text = '';
        $result = '';
    }

    $form = '
    <form method="post">
        <textarea name="wcp_text" rows="5" cols="40" placeholder="Enter your text here...">' . esc_textarea($text) . '</textarea><br>
        <input type="submit" name="wcp_submit" value="Count Words">
    </form>';

    return $form . $result;
}

// Character Count Function
function wcp_count_characters($atts) {
    if (isset($_POST['ccp_submit'])) {
        $text = sanitize_textarea_field($_POST['ccp_text']);
        $text = wp_strip_all_tags($text);
        $character_count = strlen($text);
        $result = "<p>Character count: " . $character_count . "</p>";
    } else {
        $text = '';
        $result = '';
    }

    $form = '
    <form method="post">
        <textarea name="ccp_text" rows="5" cols="40" placeholder="Enter your text here...">' . esc_textarea($text) . '</textarea><br>
        <input type="submit" name="ccp_submit" value="Count Characters">
    </form>';

    return $form . $result;
}

// Uppercase Function
function wcp_uppercase_text($atts) {
    if (isset($_POST['uppercase_submit'])) {
        $text = sanitize_textarea_field($_POST['uppercase_text']);
        $text = strtoupper(wp_strip_all_tags($text));
        $result = "<p>Uppercase: " . esc_html($text) . "</p>";
    } else {
        $text = '';
        $result = '';
    }

    $form = '
    <form method="post">
        <textarea name="uppercase_text" rows="5" cols="40" placeholder="Enter your text here...">' . esc_textarea($text) . '</textarea><br>
        <input type="submit" name="uppercase_submit" value="Convert to Uppercase">
    </form>';

    return $form . $result;
}

// Lowercase Function
function wcp_lowercase_text($atts) {
    if (isset($_POST['lowercase_submit'])) {
        $text = sanitize_textarea_field($_POST['lowercase_text']);
        $text = strtolower(wp_strip_all_tags($text));
        $result = "<p>Lowercase: " . esc_html($text) . "</p>";
    } else {
        $text = '';
        $result = '';
    }

    $form = '
    <form method="post">
        <textarea name="lowercase_text" rows="5" cols="40" placeholder="Enter your text here...">' . esc_textarea($text) . '</textarea><br>
        <input type="submit" name="lowercase_submit" value="Convert to Lowercase">
    </form>';

    return $form . $result;
}

// Capitalize Function
function wcp_capitalize_text($atts) {
    if (isset($_POST['capitalize_submit'])) {
        $text = sanitize_textarea_field($_POST['capitalize_text']);
        $text = ucwords(strtolower(wp_strip_all_tags($text)));
        $result = "<p>Capitalized: " . esc_html($text) . "</p>";
    } else {
        $text = '';
        $result = '';
    }

    $form = '
    <form method="post">
        <textarea name="capitalize_text" rows="5" cols="40" placeholder="Enter your text here...">' . esc_textarea($text) . '</textarea><br>
        <input type="submit" name="capitalize_submit" value="Convert to Capitalized">
    </form>';

    return $form . $result;
}

// Register Shortcodes
function wcp_register_shortcodes() {
    add_shortcode('word_count', 'wcp_count_words');
    add_shortcode('character_count', 'wcp_count_characters');
    add_shortcode('uppercase_text', 'wcp_uppercase_text');
    add_shortcode('lowercase_text', 'wcp_lowercase_text');
    add_shortcode('capitalize_text', 'wcp_capitalize_text');
}
add_action('init', 'wcp_register_shortcodes');
