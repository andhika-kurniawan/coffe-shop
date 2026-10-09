# Product Requirements Document (PRD): Coffee Shop Web Application

## 1. Product Vision & Scope

### 1.1 Product Overview
**Product Name:** Coffee Shop Web Application  
**Product Type:** E-commerce Web Application for Coffee Shop  
**Target Audience:** 
- **Customers:** Coffee enthusiasts who want to order coffee with customization options
- **Admin/Kasir:** Coffee shop staff managing menu, orders, and customer data

### 1.2 In-Scope Features (MVP)
- Customer-facing catalog menu with filtering and search
- Bottom sheet product customization (Sugar/Ice/Milk levels)
- Shopping cart with Alpine.js state management
- Unified checkout: Save to Database + WhatsApp redirect
- Customer authentication (login required for checkout, guest browsing allowed)
- Admin dashboard Filament v3: Menu, Category, Option management
- Live order queue with status workflow
- Order history for customers

### 1.3 Out-of-Scope (Phase 2)
- Payment gateway integration (Midtrans/Xendit)
- Loyalty/poins program
- Dark mode support
- Multi-language (Indonesian only MVP)
- Kitchen display system integration
- Advanced analytics dashboard

---

## 2. User Stories

### 2.1 Customer User Stories (As a Customer...)

| ID | User Story | Priority | Acceptance Criteria |
|----|------------|----------|---------------------|
| CU01 | "I want to browse the coffee menu without logging in" | Must | - Landing page loads with featured menu grid<br>- Filter by kategori works<br>- Search functionality returns relevant results<br>- Mobile responsive (390px)<br>- On tablet/desktop: grid shifts to 2–4 columns, filter persists, search icon remains accessible |
| CU02 | "I want to customize my coffee order (sugar, ice, milk)" | Must | - Bottom sheet opens when tapping menu item<br>- Sugar level selector works (0-100% in 25% increments)<br>- Ice level selector works (No Ice, Less, Normal, Extra)<br>- Milk type selector works (Regular, Oat, Almond, Soy)<br>- Quantity +/- buttons functional<br>- Special notes textarea available |
| CU03 | "I want to add items to my cart and review them before checkout" | Must | - Cart badge updates when item added<br>- Cart drawer shows item list with thumbnails<br>- Edit quantity functionality works<br>- Remove item functionality works<br>- Subtotal and total calculated correctly<br>- Sticky checkout bar visible at bottom |
| CU04 | "I want to checkout with WhatsApp integration" | Must | - After submit, order saves to database (status: pending)<br>- Unique order code generated (ORD-YYYYMMDD-NNN)<br>- WhatsApp URL generated with pre-filled message<br>- Redirect to WhatsApp works<br>- Message contains Order ID and Total |
| CU05 | "I want to login/register before checkout if I'm a guest" | Must | - Bottom sheet auth drawer appears when tapping checkout as guest<br>- Login form with Email/Phone + Password<br>- Register form with Name, Email, Phone, Password<br>- Redirect to checkout after auth successful<br>- Bottom sheet closes smoothly after login |
| CU06 | "I want to see my order history after purchasing" | Must | - Order History page accessible after login<br>- Cards per order with Order Code + Status Badge<br>- Created timestamp displayed<br>- Total price shown<br>- Tap to expand shows detail items |
| CU07 | "I want to filter orders by status in history" | Nice | - Filter dropdown: All, Pending, Completed, Cancelled<br>- Only relevant orders show per filter |

### 2.2 Admin User Stories (As Admin/Kasir...)

| ID | User Story | Priority | Acceptance Criteria |
|----|------------|----------|---------------------|
| AU01 | "I want to manage menu items (add/edit/delete)" | Must | - Filament Resource for Menus<br>- CRUD operations functional<br>- Image upload works<br>- Relasi ke Category display<br>- Status available/unavailable toggle |
| AU02 | "I want to manage categories" | Must | - CRUD Categories<br>- Upload icon/gambar kategori<br>- Set urutan tampil (sorting)<br>- Filter available categories |
| AU03 | "I want to manage custom options (Sugar/Ice/Milk)" | Must | - CRUD Options with type enum (sugar/ice/milk)<br>- Set value dan extra_fee per option<br>- Relasi ke Menus via pivot table<br>- Display di frontend correct |
| AU04 | "I want to see live order queue with status workflow" | Must | - Live Queue table shows all pending orders<br>- Status badge color-coded (pending/orange, confirmed/green, etc.)<br>- Filter by status works<br>- Search by Order Code + Customer Name<br>- Sort by newest first |
| AU05 | "I want to update order status (confirm → preparing → ready → completed)" | Must | - Custom Filament Actions available<br>- Each action updates status correctly<br>- Real-time refresh di Order History Customer<br>- Timestamp updated per status change |
| AU06 | "I want to view detailed order information" | Must | - Order Detail Modal shows Customer Info (name, phone)<br>- Order items with selected options displayed<br>- Total price breakdown<br>- Timestamps (created, updated)<br>- Action buttons: Confirm, Start Preparing, Mark Ready, Complete, Cancel |
| AU07 | "I want to manage customer list" | Nice | - Customer list with order history<br>- Filter by frequent buyer<br>- View individual customer detail |

---

## 3. Functional Requirements

### 3.1 Customer-Facing Features

#### FR-01: Catalog Menu Display
- **Requirement:** Display menu grid with image, name, price, and category badge
- **Input:** Menu data from database (category_id, name, price, image, status)
- **Output:** Responsive grid layout, mobile-first:
  - Mobile (320–767px): 1 kolom, spacing 16px
  - Tablet (768–1023px): 2 kolom
  - Desktop (1024–1440px): 4 kolom (max 1200px container)
- **Validation:** Only show menus with status = 'available'

#### FR-02: Product Customization Bottom Sheet
- **Requirement:** Bottom sheet drawer with kustomisasi options, adaptif ke tablet & desktop
- **Input:** Menu ID, selected options (empty/default)
- **Output:** Drawer sliding up dari bawah (mobile) atau dari kanan (tablet/desktop), berisi:
  - Sugar Level pills (0%, 25%, 50%, 75%, 100%)
  - Ice Level pills (No Ice, Less Ice, Normal Ice, Extra Ice)
  - Milk Type pills (Regular, Oat Milk, Almond Milk, Soy Milk)
  - Quantity selector (+/-)
  - Special notes textarea
- **Behavior:** 
  - Mobile: bottom sheet full-width, max-height 85vh
  - Tablet/Desktop: side drawer 420px dari kanan, max-height 84vh
  - Tutup dengan: tap backdrop, tombol close (×), atau tekan Esc

#### FR-03: Shopping Cart Management
- **Requirement:** Alpine.js state management for cart
- **Store Structure:**
  ```javascript
  Alpine.store('cart', {
    items: [],      // Array { id, menu_id, options, quantity, price }
    total: 0
  })
  ```
- **Functions:**
  - `addItem(menu, options, quantity)` → add/update item
  - `updateQuantity(itemId, newQty)` → modify quantity
  - `removeItem(itemId)` → remove from cart
  - `calculateTotal()` → return subtotal + tax + total

#### FR-04: Authentication Flow
- **Requirement:** Guest browsing + login required for checkout
- **Flow:**
  1. User browses menu → no auth required
  2. User taps "Checkout" → check auth status
  3. If guest → show bottom sheet login/register
  4. If logged in → proceed to order summary
- **Forms:**
  - Login: Email/Phone + Password
  - Register: Name + Email + Phone + Password

#### FR-05: Unified Checkout Flow
- **Requirement:** Save to DB + WhatsApp redirect
- **Steps:**
  1. Validate form (delivery info, notes)
  2. Generate order_code: `ORD-YYYYMMDD-NNN`
  3. Create Order: status = pending
  4. Create Order Items with selected_options JSON
  5. Generate WhatsApp URL: `https://wa.me/628XXXX?text={message}`
  6. Message template:
     ```
     Halo, saya ingin konfirmasi pesanan:

     Order ID: ORD-20260929-001
     Total: Rp 75.000

     [Link detail: URL order]
     ```
  7. Redirect user ke WhatsApp
  8. Clear cart (frontend Alpine.js)

#### FR-06: Order History
- **Requirement:** Display customer order history
- **Data:** `Order::where('user_id', auth()->id())->with('items.menu')->latest()->get()`
- **Layout per card:**
  - Order Code + Status Badge
  - Created timestamp (relative: "2 hours ago")
  - Total price (Rp format)
  - Tap → expand ke detail items

### 3.2 Admin Filament Features

#### FR-07: Menu CRUD (Filament Resource)
- **Resource:** `MenuResource`
- **Fields:**
  - Name (text)
  - Description (textarea)
  - Price (decimal)
  - Image (file upload)
  - Category (relasi select)
  - Status (enum: available/unavailable)
  - Sort order (number)
- **Actions:** Bulk update status, Export

#### FR-08: Category CRUD
- **Resource:** `CategoryResource`
- **Fields:** Name, Slug, Image, Sort order
- **Validation:** Unique slug

#### FR-09: Option/Variant Management
- **Resource:** `OptionResource`
- **Fields:**
  - Type (enum: sugar/ice/milk)
  - Name (display label: "50% Sugar")
  - Value (internal: "50")
  - Extra Fee (decimal: +Rp 2.000 untuk Oat Milk)
- **Many-to-Many:** Menu ↔ Option via pivot table

#### FR-10: Live Order Queue
- **Resource:** `OrderResource` (read-only table + custom actions)
- **Columns:**
  - Order Code
  - Customer Name (relasi user)
  - Status (badge color-coded)
  - Total Price (Rp format)
  - Created At (human readable)
  - Actions dropdown
- **Custom Actions:**
  - `Confirm Order` → status: confirmed
  - `Start Preparing` → status: preparing
  - `Mark Ready` → status: ready
  - `Complete` → status: completed
  - `Cancel` → status: cancelled

#### FR-11: Order Detail View (Filament ViewAction)
- **Component:** Modal drawer
- **Content:**
  - Customer info section
  - Order items loop (menu name + options + qty + price)
  - Total price breakdown
  - Status badge + timestamp
  - Action buttons bar

#### FR-12: Customer Management
- **Resource:** `CustomerResource`
- **Columns:** Name, Email, Phone, Total Orders, Total Spent
- **Filter:** Frequent buyer (orders >= 5)

---

## 4. Non-Functional Requirements

### 4.1 Performance Requirements
- **Lighthouse Performance Score:** >90 (mobile & desktop)
- **Page Load Time:** <2 detik (3G simulation)
- **Time to Interactive:** <3 detik
- **Image Optimization:** WebP format, lazy loading, max 2MB

### 4.2 Accessibility Requirements
- **Lighthouse Accessibility Score:** >90
- **WCAG 2.1 AA compliance:**
  - Color contrast minimum 4.5:1 (Primary Black #0D0D0D vs White #FFFFFF = 11.19:1 ✓)
  - Tap target minimum 44x44px
  - Focus visible on all interactive elements
  - Alt text for all images
  - Form labels associated with inputs

### 4.3 Security Requirements
- **CSRF Protection:** Laravel default (middleware web)
- **SQL Prevention:** Eloquent ORM only (no raw queries)
- **XSS Protection:** Blade `{{ }}` auto-escaping
- **Password Hashing:** bcrypt/argon2 (Laravel default)
- **Rate Limiting:** Login attempt max 5x per minute
- **Validation:** Server-side + client-side

### 4.4 Cross-Browser Compatibility
- Chrome (latest) ✓
- Safari (iOS 14+) ✓
- Firefox (latest) ✓
- Mobile Chrome Android ✓

### 4.5 Responsive Requirements (Mobile-First Approach)
- **Design Philosophy:** Mobile-first. Semua keputusan tata letak, tipografi, interaksi, dan prioritas konten dibuat untuk layar ponsel (390px) terlebih dahulu, lalu di-*scale up* ke tablet dan desktop. Desktop **bukan** versi yang diperluas tanpa perubahan; ia menerima layout yang disesuaikan (mis. grid 2–4 kolom, drawer mengganti bottom sheet, sticky bar jadi sidebar), namun hierarki dan mental model tetap mengikuti mobile.
- **Breakpoint & Behavior:**
  - **Mobile (320–767px):** 1 kolom, bottom sheet untuk kustomisasi & auth, sticky checkout bar di bawah, drawer cart dari bawah.
  - **Tablet (768–1023px):** 2 kolom grid, side drawer (420px) mengganti bottom sheet, sticky bar tetap atau jadi sidebar kanan.
  - **Desktop (1024–1440px):** 3–4 kolom grid, side drawer tetap, nav bar penuh, admin sidebar sticky kiri.
  - **Max Content Width:** 1200px (container utama); halaman admin & checkout menggunakan `shell--narrow` 780px untuk keterbacaan form.
- **Touch-first Interactions:** Semua target sentuh minimal 44×44px di semua breakpoint; hover state hanyalah *enhancement*, bukan prasyarat.
- **No Horizontal Scroll:** Konten tidak boleh overflow horizontal di breakpoint manapun.

---

## 5. Acceptance Criteria

### 5.1 Core Flow Acceptance

| Feature | Given | When | Then |
|---------|-------|------|------|
| **A01: Browse Menu** | User opens app | User sees catalog grid | Menu items display with images, names, prices |
| **A02: Customize Order** | User taps menu item | Bottom sheet opens | All kustomisasi options visible and functional |
| **A03: Add to Cart** | User selects options + quantity | User taps "Add to Cart" | Cart badge increments, drawer update |
| **A04: Checkout as Guest** | Unauthenticated user taps checkout | Auth bottom sheet appears | User can login/register or proceed after auth |
| **A05: Submit Order** | User completes form + auth | User taps "Submit" | Order saved DB (pending), WhatsApp URL generated, redirect |
| **A06: Admin Sees Order** | Order created | Admin opens Filament Dashboard | Order appears in Live Queue table with correct status |
| **A07: Admin Updates Status** | Order in pending | Admin taps "Confirm" | Status changes to confirmed, customer sees update |

### 5.2 Technical Acceptance
- **B01:** All forms have server-side validation
- **B02:** No SQL injection vulnerabilities (tested with SQLMap lite)
- **B03:** CSRF tokens present in all forms
- **B04:** Passwords hashed with bcrypt
- **B05:** Lighthouse scores: Performance >90, Accessibility >90, Best Practices >90, SEO >90
- **B06:** Mobile responsive breakpoints work at 390px, 768px, 1440px. Layout tested mobile-first: setiap breakpoint harus diuji mulai dari 320px, dan tidak boleh ada horizontal overflow di 320px, 390px, 768px, atau 1440px. Grid katalog: 1 kolom (mobile) → 2 kolom (tablet) → 4 kolom (desktop). Drawer kustomisasi: bottom sheet (mobile) → side drawer 420px (tablet/desktop).

---

## 6. Technical Specifications

### 6.1 Architecture Layers

```
┌─────────────────────────────────────────────────────────────┐
│                    PRESENTATION LAYER                       │
│  ├─ Blade Templates (+ Alpine.js interactivity)            │
│  ├─ Tailwind CSS v3 + Custom Design System                 │
│  └─ Filament v3 Panels (Admin)                            │
└─────────────────────────────────────────────────────────────┘
           ↓ (HTTP Requests)
┌─────────────────────────────────────────────────────────────┐
│                    APPLICATION LAYER                        │
│  ├─ Http/Controllers                                        │
│  ├─ Request Validation (Form Request)                      │
│  ├─ Business Logic (Service Layer - optional)              │
│  └─ Eloquent ORM Queries                                    │
└─────────────────────────────────────────────────────────────┘
           ↓ (Database Queries)
┌─────────────────────────────────────────────────────────────┐
│                    DATA LAYER                               │
│  ├─ MySQL / PostgreSQL Tables                               │
│  ├─ Eloquent Models & Relasi                               │
│  ├─ Migrations & Seeders                                    │
│  └─ Laravel Storage (Images)                               │
└─────────────────────────────────────────────────────────────┘
```

### 6.2 API Endpoints (If Needed)

```
Method  Endpoint                Description
GET     /api/menu             Fetch all available menus
GET     /api/menu/{id}        Fetch menu detail dengan options
POST    /api/cart/add         Add item to cart (Alpine store)
POST    /api/checkout       Submit order (protected)
GET     /api/orders         Customer order history
```

### 6.3 Environment Configuration

```
.env Variables:
APP_NAME=Coffee Shop
APP_ENV=local/production
APP_KEY=base64 encoded
APP_DEBUG=false (prod)
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=coffee_shop
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

WHATSAPP_NUMBER=62812345678
APP_URL=http://localhost:8000

FILESYSTEM_DISK=local
```

### 6.4 Development Commands

```
# Install
composer install
npm install

# Generate Key
php artisan key:generate

# Migrate + Seed
php artisan migrate --seed

# Run Filament
php artisan filament:install --panels

# Dev Server
php artisan serve  (port 8000)
npm run dev        (Vite watch)

# Production Build
npm run build

# Test
php artisan test

# Lint (if configured)
php artisan lint  (if php-cs-fixer)
```

---

## 7. Data Requirements

### 7.1 Key Tables & Columns (Prioritized for MVP)

| Table | Critical Columns | Purpose |
|-------|-----------------|---------|
| **users** | id, name, email, phone, password, email_verified_at | Auth + customer profile |
| **categories** | id, name, slug, order | Menu categorization |
| **menus** | id, category_id, name, price, image, status | Product catalog |
| **options** | id, type, name, value, extra_fee | Customization variants |
| **order_items** | id, order_id, menu_id, quantity, price, selected_options | Order detail items |
| **orders** | id, user_id, order_code, status, total, notes | Main order record |

### 7.2 JSON Fields (Selected Options)

```json
// selected_options di order_items
{
  "sugar": "50",
  "ice": "normal", 
  "milk": "oat"
}

// delivery_info di orders (nullable)
{
  "type": "delivery", // atau "table"
  "address": "Jl. Contoh No. 123",
  "table_number": "5",
  "name": "Andika"
}
```

### 7.3 Seeder Data Priority

**Category Seeder (5 items):**
1. Coffee
2. Non-Coffee  
3. Snacks
4. Desserts
5. Beverages

**Option Seeder (3 types × 5-7 values):**
- Sugar: 0, 25, 50, 75, 100
- Ice: none, less, normal, extra
- Milk: regular, oat, almond, soy

**Menu Seeder (20 items):**
- 8 Coffee variants
- 4 Non-Coffee
- 4 Snacks
- 4 Desserts
- 4 Specials

**User Seeder:**
- 1 Admin (filament user)
- 5 Customer dummy

---

## 8. Integration Requirements

### 8.1 WhatsApp Integration

**Gateway:** WhatsApp Web API (URL scheme)  
**Endpoint:** `https://wa.me/{NOMEPONTOKO}?text={URLEncodedMessage}`

**Message Template Format:**
```
Halo, saya ingin konfirmasi pesanan:

Order ID: ORD-20260929-001
Total: Rp 75.000

Link detail: http://domain.com/orders/1
```

**Fallback:** Jika WhatsApp tidak terinstall, show "Copy Order Code" button

### 8.2 Third-Party Services

| Service | Purpose | Configuration |
|---------|---------|---------------|
| Laravel Breeze/Fortify | Authentication | Views customization ke monochrome |
| Tailwind CSS | Styling | Custom color palette config |
| Vite | Asset Bundler | Production minification |
| Laravel Storage | Image upload | local/S3 depending on hosting |
| Filament v3 | Admin Panel | Panel setup + Resources |

---

## 9. Deployment Requirements

### 9.1 Server Requirements

```
PHP: 8.2+
MySQL: 8.0+ or PostgreSQL 14+
Web Server: Apache 2.4+ or Nginx 1.18+
RAM: Minimum 1GB (recommended 2GB)
Disk: Minimum 2GB free space
```

### 9.2 PHP Extensions Required

```
- php-mbstring
- php-tokenizer
- php-xml
- php-ctype
- php-json
- php-pdo
- php-fileinfo
- php-curl (optional, untuk HTTP client)
```

### 9.3 Deployment Checklist

```
☐ Configure .env.production (DB, APP_URL, DEBUG=false)
☐ Run: php artisan migrate --force
☐ Run: php artisan storage:link
☐ Run: npm run build (Vite production)
☐ Generate SSL (Let's Encrypt/Certbot)
☐ Configure web server:
  - Apache: .htaccess redirect /public
  - Nginx: server block ke /public
☐ Set file permissions (storage/, bootstrap/cache/)
☐ Schedule daily backup (database + storage)
☐ Monitoring setup (error logs, server resources)
```

### 9.4 Post-Deployment Testing

```
☐ Test all CRUD operations
☐ Test checkout flow end-to-end
☐ Test WhatsApp redirect pada device berbeda
☐ Test responsive pada 3 device: mobile, tablet, desktop
☐ Test error handling (404, 500 pages)
☐ Verify Lighthouse scores
☐ Check admin login credentials
```

---

## 10. Success Metrics & KPIs

### 10.1 Technical KPIs (Launch Day)
- [ ] Lighthouse Performance: >90
- [ ] Lighthouse Accessibility: >90
- [ ] Zero critical security vulnerabilities
- [ ] 100% CRUD functionality working
- [ ] Zero bugs blocking checkout flow

### 10.2 User Experience KPIs (Post-Launch 2 Weeks)
- [ ] Average Checkout Time: <3 menit
- [ ] Cart Abandonment Rate: <30%
- [ ] Mobile Traffic Percentage: >70%
- [ ] Order Success Rate (via WhatsApp): >95%
- [ ] Admin Order Queue Update Speed: <5 detik

### 10.3 Portfolio KPIs
- [ ] Figma case study completed (8+ screens)
- [ ] Professional PRD + Project Brief documentation
- [ ] Live demo URL accessible
- [ ] Code repository public (dengan README)
- [ ] End-to-end test video recorded

---

## 11. Appendix

### 11.1 Design System Tokens (Figma → Dev)

**Prinsip:** Token ini disusun dan diuji mulai dari viewport mobile (390px) lalu di-*scale up*. Nilai di bawah adalah nilai mobile-first; tablet dan desktop memakai nilai yang sama, hanya jarak dan jumlah kolom yang bertambah.

**Layout Grid (mobile-first):**
```json
{
  "mobile":  {"columns": 1, "gutter": 16, "container_padding": 16},
  "tablet":  {"columns": 2, "gutter": 16, "container_padding": 24},
  "desktop": {"columns": 4, "gutter": 16, "container_max_width": 1200, "container_padding": 32}
}
```

**Colors:**
```json
{
  "primary": "#0D0D0D",
  "background": "#FFFFFF", 
  "neutral": "#F5F5F7",
  "border": "#E5E5EA",
  "success": "#34C759",
  "warning": "#FF9500",
  "error": "#FF3B30"
}
```

**Typography Scale:**
```json
{
  "h1": {"size": "32px", "weight": 700},
  "h2": {"size": "24px", "weight": 700},
  "h3": {"size": "20px", "weight": 600},
  "body-lg": {"size": "16px", "weight": 500},
  "body-md": {"size": "14px", "weight": 400},
  "body-sm": {"size": "12px", "weight": 400},
  "label": {"size": "14px", "weight": 600, "transform": "uppercase", "letter_spacing": 0.5}
}
```

**Spacing Scale:**
```json
{
  "xs": 4, "sm": 8, "md": 16, "lg": 24, "xl": 32, "2xl": 48
}
```

### 11.2 Mermaid Diagram Key

- **flowchart:** Top-down flow diagram
- **stateDiagram-v2:** State machine diagram  
- **Layout:** Left-to-right (LR) or Top-to-Bottom (TB)

### 11.3 Risks & Mitigations Summary

| Risk | Impact | Mitigation |
|------|--------|------------|
| WhatsApp redirect failure | Medium | Fallback: Copy Order Code button |
| Solo developer burnout | High | Realistic daily goals, AI assistant |
| Database schema changes | High | Migrations with rollback |
| Alpine.js cart loss on refresh | High | LocalStorage persistence |
| Image size too large | Medium | Validation 2MB max, compress |

---

**PRD Version:** 1.1  
**Last Updated:** 2026-09-29  
**Derived From:** project-brief.md v1.0  
**Next Review:** End of Sprint 1  

**Changelog v1.1:**
- Menegaskan pendekatan **mobile-first** di section 4.5: desain, tata letak, dan interaksi dibangun untuk 390px terlebih dahulu, lalu disesuaikan untuk tablet (768px) dan desktop (1024px+), bukan sekadar diperbesar.
- Menambahkan prinsip *touch-first* (target 44px di semua breakpoint) dan larangan horizontal overflow.
- Update FR-01 (grid responsif per breakpoint) dan FR-02 (bottom sheet di mobile, side drawer di tablet/desktop).
- Update acceptance criteria B06 agar pengujian dimulai dari 320px dan mencakup overflow check.
- Menambahkan layout grid token per breakpoint di Appendix 11.1.

**Document Purpose:** This PRD serves as the definitive requirements specification for the Coffee Shop Web Application development. All development work should reference this document for feature implementation, testing, and scope management.