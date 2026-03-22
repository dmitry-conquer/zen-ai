# Website Setup Guide

This template lets you build professional landing pages with Claude AI.
Your job is to prepare the content, images, and design references. Claude handles the rest.

---

## What to prepare before starting

### 1. Text content
**File:** `content/content-homepage.md`

Open the file and fill in all fields marked `[PLACEHOLDER]`:

| Section | What to fill in |
|---|---|
| `hero` | Main headline, subheadline, button labels |
| `trust-badges` | 4 short trust points (example already provided) |
| `about` | Heading and company description |
| `why-choose-us` | 4 reasons to choose you (title + body each) |
| `services` | Name, description, and CTA for each service |
| `brands` | Names of brands you work with |
| `cta` | Call-to-action heading, subheading, button label |
| `contact` | Address, phones, email, business hours, service area |
| `credentials` | License numbers, accepted payment methods |
| `meta` | Page title, Google description (150–160 characters) |

> Do not remove the section structure — only replace `[PLACEHOLDER]` with real data.

---

### 2. Images
**Folder:** `public/images/`
**Manifest:** `public/images/images.md`

**Steps:**
1. Add image files to the `public/images/` folder
2. Open `public/images/images.md`
3. Find the matching row and change `[ ]` to `[x]`

```
| [ ]   | hero.jpg   |   ← image not yet added
| [x]   | hero.jpg   |   ← image added, Claude can use it
```

**Required images:**

| File | Description | Size |
|---|---|---|
| `hero.jpg` | Hero section background photo | min. 1920×1080 px |
| `about.jpg` | About section photo | min. 800×600 px |
| `og-image.jpg` | Social media share image | 1200×630 px |
| `service-[name].jpg` | Photo for each service card | 16:9 ratio |
| `brand-[name].svg` | Brand logos | SVG preferred, PNG fallback |

> If an image is missing — leave `[ ]`. Claude will insert a grey placeholder and leave a comment. You can add the image later.

---

### 3. Design references
**Folder:** `design-examples/`

Drop screenshots or images of websites you like here — competitors, inspiration, examples with good design. Claude will analyze them and match the visual style.

Supported formats: `.jpg`, `.png`, `.webp` — any works.

> The more examples you provide, the more accurately Claude will match your desired style.

---

### 4. Colors and fonts
**File:** `.claude/rules/layout.md` → sections `## Typography & Fonts` and `## Colors`

**Fonts:**
Open the file and find these lines:
```
- **Body font:** Open Sans
- **Accent/heading font:** _(none)_
```
Replace the font names with the ones you want (use names from Google Fonts).
If you only need one font — leave the second line as is.
If you're not sure — leave `Open Sans`, Claude will adapt based on the design references.

**Colors:**
If you have brand colors — find the section `### If colors are specified for this project` in the same file and add the Tailwind color classes (e.g., `bg-blue-900`, `text-orange-500`).
If you don't have specific colors — leave it as is. Claude will pick colors from the design references.

---

### 5. Project settings
**File:** `CLAUDE.md`

Update the project name and type:
```
- **Type:** HVAC service landing page     ← change to your business type
```

---

## Page structure

Sections are built top to bottom in this order (no need to change the order):

1. **Header** — navigation bar
2. **Hero** — main banner
3. **Trust strip** — quick trust highlights
4. **About** — company overview
5. **Why choose us** — your key advantages
6. **Services** — service cards
7. **Brands** — brands you work with
8. **CTA** — call to action
9. **Contact** — contact details
10. **Credentials** — licenses and payment
11. **Footer** — site footer

Full specification: `content/structure.md`

---

## How to work with Claude

### First time
1. Install dependencies: `npm install`
2. Start the dev server: `npm run dev`
3. Open a new Claude Code session

### Starting each session
Open `prompt.md`, copy the text inside the ``` block, and paste it as your first message to Claude.
Claude will read all necessary files and confirm its understanding of the project — only give further instructions after it confirms.

### Commands for Claude
All prompt templates are in `CLAUDE.md → ## Prompt templates`.

Examples:
- *"Build the hero section"*
- *"Build the services section"*
- *"Review the about section"*

---

## Do not touch

These files are configured and should not be modified unless you have specific requirements:

| File / Folder | Why |
|---|---|
| `src/scripts/main.ts` | All library imports and initialization |
| `src/styles/main.css` | Base styles (Google Fonts added by Claude) |
| `vite.config.js` | Build configuration |
| `components/header.html` | Built by Claude |
| `components/footer.html` | Built by Claude |
| `.claude/rules/` | Claude's working rules — do not edit |
| `tsconfig.json` | TypeScript configuration |

---

## Final build

When the site is ready:
```
npm run build
```
Production files will be in the `dist/` folder.
