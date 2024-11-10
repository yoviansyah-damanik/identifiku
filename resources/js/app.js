import './bootstrap';

import.meta.glob([
    '../images/**',
]);

import anchor from '@alpinejs/anchor';
Alpine.plugin(anchor)

import sort from '@alpinejs/sort';
Alpine.plugin(sort)

import collapse from '@alpinejs/collapse';
Alpine.plugin(collapse)
