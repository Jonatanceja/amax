import './bootstrap';

// Uncomment if you need Alpine.js
import Alpine from 'alpinejs'
import example from './components/AlpineExample'
Alpine.data('example', example)

Alpine.data('themeToggle', () => ({
  mode: localStorage.getItem('theme') || 'system',
  init() {
    this.apply();
  },
  next() {
    const modes = ['system', 'light', 'dark'];
    this.mode = modes[(modes.indexOf(this.mode) + 1) % 3];
    if (this.mode === 'system') {
      localStorage.removeItem('theme');
    } else {
      localStorage.setItem('theme', this.mode);
    }
    this.apply();
  },
  apply() {
    const html = document.documentElement;
    if (this.mode === 'dark') {
      html.classList.add('dark');
    } else if (this.mode === 'light') {
      html.classList.remove('dark');
    } else {
      if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
        html.classList.add('dark');
      } else {
        html.classList.remove('dark');
      }
    }
  },
}));

window.Alpine = Alpine
Alpine.start()

// Fancybox
import { Fancybox } from "@fancyapps/ui";
import "@fancyapps/ui/dist/fancybox/fancybox.css";
Fancybox.bind("[data-fancybox]");

// GSAP
import { gsap } from "gsap";
import { ScrollToPlugin } from "gsap/ScrollToPlugin";
import { ScrollTrigger } from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollToPlugin, ScrollTrigger);

function initHero() {
  const hero = document.getElementById('hero');
  if (!hero) return;

  const tl = gsap.timeline({ defaults: { ease: 'power4.out' } });

  // Ken Burns: slow zoom out on image
  const heroImage = document.getElementById('hero-image');
  if (heroImage) {
    tl.to(heroImage, { scale: 1, duration: 2.6, ease: 'power2.out' }, 0);
  }

  // Split title words into masked spans, animate each up
  const title = document.getElementById('hero-title');
  if (title) {
    const words = title.innerText.trim().split(/\s+/);
    title.innerHTML = words
      .map(w => `<span class="inline-block overflow-hidden leading-tight"><span class="inline-block hero-word translate-y-full">${w}</span></span>`)
      .join(' ');

    tl.to('.hero-word', {
      y: 0,
      duration: 1,
      stagger: 0.09,
    }, 0.5);
  }

  // Decorative line expands after title
  const line = document.getElementById('hero-line');
  if (line) {
    tl.to(line, { width: '4rem', duration: 0.6, ease: 'power2.inOut' }, 1.2);
  }

  // Subtitle rises + fades in after title
  const subtitle = document.getElementById('hero-subtitle');
  if (subtitle) {
    gsap.set(subtitle, { y: 24, opacity: 0 });
    tl.to(subtitle, { opacity: 1, y: 0, duration: 0.9 }, 1.3);
  }

  // Scroll indicator fades in last, dot bounces
  const indicator = document.getElementById('hero-scroll-indicator');
  if (indicator) {
    tl.to(indicator, { color: 'rgba(255,255,255,0.8)', duration: 0.6 }, 1.9);

    const dot = document.getElementById('hero-scroll-dot');
    if (dot) {
      tl.to(dot, {
        y: 20,
        duration: 1.2,
        ease: 'power1.inOut',
        repeat: -1,
        yoyo: true,
      }, 2.2);
    }
  }
}

function initScrollFade() {
  gsap.utils.toArray('.gsap-fade').forEach((el) => {
    gsap.from(el, {
      opacity: 0,
      y: 40,
      duration: 1.2,
      ease: 'power2.out',
      scrollTrigger: {
        trigger: el,
        start: 'top 85%',
        once: true,
      },
    });
  });
}

document.addEventListener('DOMContentLoaded', () => {
  initHero();
  initScrollFade();
});
