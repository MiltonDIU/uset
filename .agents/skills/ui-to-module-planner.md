---
name: ui-to-module-planner
description: >
  Analyzes university website frontend files from `public/html/*`
  and produces a backend-ready Laravel module plan.

  The system is already built on Laravel 13 with Filament 5 and
  Filament Shield (roles & permissions). The output must align
  with this architecture and focus on admin-manageable modules.

  MUST ALWAYS include Menu Management and Page Builder.

  Trigger this skill when HTML/templates are provided or when the user
  asks to map frontend into backend modules.

  Output must be practical for direct implementation in an existing system
  (not theoretical).
---

# UI → Laravel Module Planner (Execution Mode)

You are working on an already initialized system:

- Laravel 13 ✅
- Filament 5 (admin panel) ✅
- Filament Shield (roles & permissions) ✅
- HTML templates located in: `public/html/*`

Your job is to convert UI into **admin-manageable backend modules**.

---

## ⚠️ Fixed Architecture Rules

- Backend only (no frontend framework suggestion)
- Admin will manage everything via Filament
- Every entity must be:
  - CRUD manageable
  - Permission controlled (via Shield)
- Avoid unnecessary complexity (keep it production-ready)

---

## Step 1 — Read Files from `public/html/*`

- Scan all HTML, CSS, JS
- Identify:
  - Pages
  - Sections
  - Repeatable components
  - Navigation structure

Do NOT guess. Only use actual structure.

---

## Step 2 — Detect CMS Needs

### 🔹 MUST Detect

#### Navigation → Menu System
- Header menu
- Footer links
- Dropdowns

#### Sections → Page Builder Blocks
Detect:
- Hero sections
- Sliders
- Card grids
- CTA blocks
- Content sections

These MUST map to dynamic blocks.

---

## Step 3 — Extract Entities

Same as before, but:

👉 Only include entities that admin needs to manage  
👉 Ignore purely visual/static markup  

---

## Step 4 — Enforce Core CMS Modules

### 🧩 Pages Module (CORE)
Dynamic content system:

- Page (title, slug, layout_json, is_published)
- PageSection (type, content_json, order)

👉 Used to rebuild ALL HTML pages dynamically

---

### 📑 Menu Module (CORE)

- Menu (name, location: header/footer)
- MenuItem (parent_id, title, link_type, url, page_id, order)

---

## Step 5 — Module Mapping (Backend-focused)

| Module | Purpose |
|---|---|
| Pages | Page builder + dynamic content |
| Settings | Menu + global config |
| Academic | Faculty, Department, Program |
| Staff | Staff profiles |
| News | Blog/news |
| Events | Events |
| Gallery | Media albums |
| Alumni | Alumni profiles |
| Campus | Facilities/map |
| Downloads | Files/PDF |
| Contacts | Contact form + info |

---

## Step 6 — Output Format

### 📋 Module Plan — University Website (Backend)

**HTML Source:** `public/html/*`

---

#### Module: `Pages`
**Purpose:** Manage all dynamic page content using page builder.

| Entity | Fields | Relationships |
|---|---|---|
| Page | id, title, slug, layout_json, is_published | has many PageSection |
| PageSection | id, page_id, type, content_json, order | belongs to Page |

**Notes:**
- layout_json stores structure
- content_json stores block data
- supports drag/drop ordering

---

#### Module: `Settings`
**Purpose:** Manage menus and global settings.

| Entity | Fields | Relationships |
|---|---|---|
| Menu | id, name, location | has many MenuItem |
| MenuItem | id, menu_id, parent_id, title, link_type, url, page_id, order | belongs to Menu |

---

*(other modules based on HTML)*

---

### 🗺️ Relationship Map
(tree...)

---

### ✅ Build Order

1. Settings
2. Pages
3. Academic
4. Others...

---
