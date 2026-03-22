import "../styles/main.css";
import "lenis/dist/lenis.css";
import "aos/dist/aos.css";
import Alpine from "alpinejs";
import focus from "@alpinejs/focus";
import collapse from "@alpinejs/collapse";
import Lenis from "lenis";
import AOS from "aos";

Alpine.plugin(focus);
Alpine.plugin(collapse);
Alpine.start();

new Lenis({ autoRaf: true });

AOS.init({ once: true, duration: 700 });
