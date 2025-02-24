<?php
/**
 * Plugin Name: Image Compressor Plugin
 * Description: A simple image compressor tool with a shortcode.
 * Version: 1.0
 * Author: Vineet talwar
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Register the shortcode
function icp_image_compressor_shortcode() {
    ob_start(); ?>
    
    <div class="image-compressor-container">
        <h1>Image Compressor Tool</h1>
        
        <form id="image-compressor-form" enctype="multipart/form-data">
            <label for="image-upload">Upload an Image:</label>
            <input type="file" id="image-upload" name="image" accept="image/*" required>
            <button type="submit">Compress Image</button>
        </form>

        <div id="output">
            <h2>Compressed Image:</h2>
            <div id="compressed-image"></div>
            <a id="download-link" href="#" download>Download Compressed Image</a>
        </div>
    </div>

    <?php
    return ob_get_clean();
}
add_shortcode( 'image_compressor', 'icp_image_compressor_shortcode' );

// Enqueue scripts and styles
function icp_enqueue_scripts() {
    wp_enqueue_style( 'icp-style', plugins_url( 'assets/css/image-compressor.css', __FILE__ ) );
    wp_enqueue_script( 'icp-script', plugins_url( 'assets/js/image-compressor.js', __FILE__ ), array(), null, true );
}
add_action( 'wp_enqueue_scripts', 'icp_enqueue_scripts' );
