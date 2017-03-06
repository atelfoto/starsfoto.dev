# CakePHP Plugin Sluggable

[![Build Status](https://travis-ci.org/Grafikart/CakePHP-Sluggable.png?branch=master)](https://travis-ci.org/Grafikart/CakePHP-Sluggable)

This plugin is used to automatically generate slug from a field.

## Requirements

* CakePHP 2.x
* Keyboad + Mouse

## Installation

Load the plugin using bootstrap.php

    CakePlugin::load('Sluggable');

## Usage

This plugin work as a behaviour for your model so you have to attach it to your model

	public $actsAs = array(
		'Sluggable.Sluggable' => array(
	        'field'     => 'name',  // Field that will be slugged
	        'slug'      => 'slug',  // Field that will be used for the slug
	        'lowercase' => true,    // Do we lowercase the slug ?
	        'separator' => '-',     //
	        'overwrite' => false    // Does the slug is auto generated when field is saved no matter what
		)
	);