import './bootstrap';
import './dark';

import Alpine from 'alpinejs';

import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css"; // ✅ v6 path

window.Alpine = Alpine;

// Initialize Fancybox
Fancybox.bind("[data-fancybox]", {});

Alpine.start();
