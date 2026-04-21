---
name: academic-core-module
description: Core academic hierarchy module for university systems including Faculty, Department, Program, Tuition, and polymorphic Facilities with tab-based admin UI.
---

# Academic Core Module

This module defines a clean and scalable academic structure:

Faculty → Department → Program

It includes essential program-level features like:
- Overview & Description
- Tuition Management
- Facilities (Polymorphic)

---

##  Core Hierarchy
Faculty
└── Department
└── Program
├── Tuition
└── Facilities (Polymorphic)


---

##  Database Schema

### Faculties
- id
- name
- slug
- code
- short_description
- description
- feature_image
- sort_order
- is_active
- timestamps
- softDeletes

---

### Departments
- id
- faculty_id (FK)
- name
- slug
- code
- sort_order
- feature_image
- description
- is_active
- timestamps
- softDeletes

---

### Program Types
- id
- name
- slug
- sort_order
- is_active
- timestamps
- softDeletes

---

### Programs
- id
- department_id (FK)
- program_type_id (FK)
- name
- sub_title
- slug
- short_description
- overview (longText, nullable)
- description (longText)
- duration
- total_semester
- semester_duration
- sort_order
- is_active
- timestamps
- softDeletes

---

##  Tuition System

### Tuition Types
- id
- name (National / International)
- slug
- sort_order
- is_active
- timestamps
- softDeletes

---

### Tuitions
- id
- program_id (FK)
- tuition_type_id (FK)
- min_credit
- max_credit
- min_total_cost
- max_total_cost
- min_tuition_fee
- max_tuition_fee
- admission_fee
- sort_order
- is_active
- timestamps
- softDeletes

---

##  Facilities (Polymorphic)

### facilities table

- id
- facilityable_id
- facilityable_type
- title
- description
- icon (optional)
- image (optional)
- sort_order
- is_active
- timestamps
- softDeletes

---

##  Relationships

### Faculty
- hasMany Departments

### Department
- belongsTo Faculty
- hasMany Programs

### Program
- belongsTo Department
- belongsTo ProgramType
- hasMany Tuitions
- morphMany Facilities

### Facility
- morphTo facilityable

---

##  Admin UI (Filament आधारित)

Program resource must use **Tabs for better UX**
 
###  Directory Structure Convention
- All Filament resources must follow the nested modular structure.
- The main resource file **must** be placed inside its own directory within `Resources/`.
- Example: `Modules/Academic/app/Filament/Resources/FacultyResource/FacultyResource.php` instead of being outside the folder.
- All associated `Pages`, `Schemas`, and `Tables` remain in their respective sub-folders within that resource directory.

---

###  Tab 1: General Information

- department_id
- program_type_id
- name
- sub_title
- slug
- short_description
- overview (Rich Editor)
- description (Rich Editor)
- duration
- total_semester
- semester_duration
- sort_order
- is_active

---

###  Tab 2: Tuition Fees

Use Repeater or Relation Manager

Fields:
- tuition_type_id
- min_credit
- max_credit
- min_total_cost
- max_total_cost
- min_tuition_fee
- max_tuition_fee
- admission_fee
- sort_order
- is_active

---

###  Tab 3: Facilities

Polymorphic Repeater (same UX as tuition)

Fields:
- title
- description
- icon
- image
- sort_order
- is_active

---

##  Implementation Guidelines

- Use foreign key constraints
- Use softDeletes everywhere
- Maintain `sort_order` for frontend ترتيب
- Slug must be unique
- Use eager loading for performance
- Use `is_active` instead of delete for visibility control
- **Filament Table Actions**: Always use `Filament\Actions` namespace for table actions (BulkActionGroup, DeleteAction, DeleteBulkAction, EditAction, Action). Do NOT use `Filament\Tables\Actions`.
- **Table Management UI**:
  - Enable `->columnManager()` and `->filtersTriggerAction()`.
  - Both must use `->slideOver()` trigger actions for better UX.
  - Example:
    ```php
    ->filtersTriggerAction(fn (Action $action) => $action->button()->label('Filter')->slideOver())
    ->columnManagerTriggerAction(fn (Action $action) => $action->button()->label('Column')->slideOver())
    ```
- **Sorting**: Enable reordering via `->reorderable('sort_order')` and set `->defaultSort('sort_order', 'asc')`.

---

##  Design Decisions

### Why Overview inside Program?
- Avoid unnecessary table
- Simple use-case
- Easy to extend later

### Why Polymorphic Facilities?
- Reusable across:
  - Program
  - Department (future)
  - Faculty (future)
- Avoid duplicate tables
- Keeps system DRY

---

##  Things to Avoid

-  Storing everything in a single description field
-  Hardcoding facilities in frontend
-  Creating separate facility tables per entity
-  Skipping sort_order (breaks UI consistency)

---

##  Future Extension Ready

This module can later integrate with:

- Course & Curriculum Module
- Academic Standards Module (Grading, Credit System)
- Routine Management System
- LMS Integration (Moodle, etc.)

---

##  Summary

This module provides:

- Clean academic hierarchy
- Modular and scalable architecture
- সুন্দর tab-based admin UX
- Reusable polymorphic design

Build this first, then extend safely without refactoring.