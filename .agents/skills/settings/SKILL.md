---
name: laravel-filament-university-menu-seeder
description: ইউনিভার্সিটি ম্যানেজমেন্ট সিস্টেমের জন্য Filament Menu Builder প্যাকেজ অনুযায়ী সম্পূর্ণ Database Seeder তৈরি করার স্কিল। হোম, অ্যাডমিশন, একাডেমিক, ক্যাম্পাস লাইফ, রিসার্চ, কন্টাক্ট ইত্যাদি বিভাগ এবং তাদের সাব-মেনু সহ নেস্টেড স্ট্রাকচার তৈরি করে।
license: MIT
compatibility: Laravel 13.x, Filament 5.x, biostate/filament-menu-builder:^5.0
allowed-tools: Bash(php artisan make:seeder) Bash(php artisan db:seed)
---

# Laravel Filament Menu Builder - University Menu Seeder Skill

এই স্কিলটি `biostate/filament-menu-builder` প্যাকেজের জন্য **ইউনিভার্সিটি ভিত্তিক সম্পূর্ণ মেনু স্ট্রাকচার** তৈরি করবে। Laravel 13 এবং Filament 5 এর সাথে সম্পূর্ণ সামঞ্জস্যপূর্ণ।

## 1. কখন এই স্কিলটি ব্যবহার করবেন

- যখন ইউজার বলবেন: "ইউনিভার্সিটির যে যে মেনু থাকে সেই মেনুগুলো সিড ফাইলের মাধ্যমে এন্ট্রি করার জন্য সিডার ফাইল তৈরি করতে চাই"
- ইউনিভার্সিটি ওয়েবসাইটের জন্য হোম, অ্যাডমিশন, একাডেমিক, রিসার্চ, কন্টাক্ট ইত্যাদি মেনু তৈরি করতে চাইলে
- নেস্টেড মেনু (ড্রপডাউন) সহ সম্পূর্ণ নেভিগেশন স্ট্রাকচার সেটআপ করতে চাইলে
- Laravel 13 + Filament 5 প্রোজেক্টে ডেমো ডাটা পপুলেট করতে চাইলে

## 2. Seeder ফাইল তৈরি করুন

### ধাপ ১: Seeder ক্লাস তৈরি করুন

```bash
php artisan make:seeder UniversityMenuSeeder
