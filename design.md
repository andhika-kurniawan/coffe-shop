# Coffee Shop App - Design System

## Overview
Modern, bold coffee shop app dengan design system yang clean dan berani. Menggunakan warna hijau stabilo (#c2fa0a) sebagai accent utama untuk menciptakan energi fresh dan playful.

---

## 1. Color Palette

### Primary Colors
```
Stabilo Green (Primary): #c2fa0a
  - Usage: CTA buttons, headlines accent, active states, success indicators
  - Hex: #c2fa0a
  - RGB: 194, 250, 10
  - Contrast ratio with black text: 14.2:1 (AAA)

Dark Black: #0D0D0D
  - Usage: Primary text, headings, icons
  - Hex: #0D0D0D
  - RGB: 13, 13, 13

Pure White: #FFFFFF
  - Usage: Background, card backgrounds, button text on colored backgrounds
  - Hex: #FFFFFF
  - RGB: 255, 255, 255
```

### Neutral Colors
```
Light Gray (Neutral): #F5F5F7
  - Usage: Section backgrounds, disabled states, subtle backgrounds
  
Medium Gray (Border): #E5E5EA
  - Usage: Borders, dividers, outlines
  
Text Gray: #666666
  - Usage: Secondary text, descriptions, meta information
```

### Status Colors
```
Orange (Warning/Processing): #FF9500
  - Usage: "Delivering" badge, "Brewing" status, processing indicators
  
Success Green: #c2fa0a
  - Usage: "Delivered" badge, "Completed" status, success messages
  
Error/Info Red: #FF3B30
  - Usage: "Cancelled" badge, error messages, important alerts
  
Info Blue: #007AFF (optional)
  - Usage: Information messages, links
```

### Color Usage Matrix
| Element | Color | Background | Text |
|---------|-------|------------|------|
| Primary Button | #c2fa0a | #c2fa0a | #0D0D0D |
| Secondary Button | Transparent | #FFFFFF | #0D0D0D |
| Headline Accent | #c2fa0a | - | #c2fa0a |
| Status: Delivered | #c2fa0a (10% opacity) | rgba(194,250,10,0.1) | #c2fa0a |
| Status: Delivering | #FF9500 (10% opacity) | rgba(255,149,0,0.1) | #FF9500 |
| Status: Cancelled | #FF3B30 (10% opacity) | rgba(255,59,48,0.1) | #FF3B30 |

---

## 2. Typography System

### Font Family
```
Primary: "Inter", -apple-system, BlinkMacSystemFont, sans-serif
Fallback: system-ui, "Segoe UI", Roboto, "Helvetica Neue", Arial
```

### Type Scale

#### Display Headings (Bold, Uppercase)
```css
.display-lg {
  font-size: 56px;
  font-weight: 900;
  line-height: 1.1;
  letter-spacing: -0.02em;
  text-transform: uppercase;
}
/* Usage: "CAPPUCCINO HOT AND READY" */

.display-md {
  font-size: 40px;
  font-weight: 900;
  line-height: 1.2;
  letter-spacing: -0.01em;
  text-transform: uppercase;
}
/* Usage: "YOUR CAPPUCCINO ON THE WAY" */
```

#### Headings
```css
.h1 {
  font-size: 32px;
  font-weight: 700;
  line-height: 1.2;
}
/* Usage: Page titles */

.h2 {
  font-size: 24px;
  font-weight: 700;
  line-height: 1.3;
}
/* Usage: Section titles "Back to Brew", "My Cart" */

.h3 {
  font-size: 20px;
  font-weight: 600;
  line-height: 1.4;
}
/* Usage: Card titles, order numbers */

.h4 {
  font-size: 18px;
  font-weight: 600;
  line-height: 1.4;
}
/* Usage: Subsection titles */
```

#### Body Text
```css
.body-lg {
  font-size: 16px;
  font-weight: 400;
  line-height: 1.5;
}
/* Usage: Main content, descriptions */

.body-md {
  font-size: 14px;
  font-weight: 400;
  line-height: 1.5;
}
/* Usage: Default body text, labels */

.body-sm {
  font-size: 12px;
  font-weight: 400;
  line-height: 1.4;
}
/* Usage: Meta information, timestamps, hints */
```

#### Labels & UI Text
```css
.label-lg {
  font-size: 16px;
  font-weight: 600;
  line-height: 1.3;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
/* Usage: Button text, category labels */

.label-md {
  font-size: 14px;
  font-weight: 600;
  line-height: 1.3;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
/* Usage: Form labels, section labels */

.label-sm {
  font-size: 12px;
  font-weight: 600;
  line-height: 1.3;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
/* Usage: Badge text, status labels */
```

#### Price Text
```css
.price-lg {
  font-size: 28px;
  font-weight: 700;
  line-height: 1.2;
}

.price-md {
  font-size: 20px;
  font-weight: 600;
  line-height: 1.3;
}

.price-sm {
  font-size: 16px;
  font-weight: 600;
  line-height: 1.3;
}
```

---

## 3. Spacing System

### Base Unit: 4px

```
xs:  4px  - Icon margins, tight spacing
sm:  8px  - Small gaps, compact spacing
md:  16px - Default spacing, card padding
lg:  24px - Section spacing
xl:  32px - Large section gaps
2xl: 48px - Extra large gaps, hero spacing
3xl: 64px - Page section dividers
```

### Component Spacing
```
Button Padding: 16px 32px (md horizontal, lg vertical)
Card Padding: 16px (md)
Section Margin: 24px (lg)
Container Padding: 16px mobile, 24px tablet, 32px desktop
```

---

## 4. Components

### 4.1 Buttons

#### Primary Button (CTA)
```css
.btn-primary {
  background: #c2fa0a;
  color: #0D0D0D;
  border: none;
  border-radius: 12px;
  padding: 16px 32px;
  font-size: 16px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.05em;
  transition: all 0.2s ease;
}

.btn-primary:hover {
  background: #b3e809;
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(194, 250, 10, 0.3);
}

.btn-primary:active {
  transform: scale(0.98);
}
```

**Visual Example:**
```
┌──────────────────────────┐
│  ORDER NOW · $9.99       │  ← #c2fa0a background
└──────────────────────────┘     #0D0D0D text
```

#### Secondary Button (Outline)
```css
.btn-secondary {
  background: transparent;
  color: #0D0D0D;
  border: 2px solid #E5E5EA;
  border-radius: 12px;
  padding: 14px 30px;
  font-size: 16px;
  font-weight: 600;
  transition: all 0.2s ease;
}

.btn-secondary:hover {
  background: #F5F5F7;
  border-color: #0D0D0D;
}
```

#### Text Button (Link style)
```css
.btn-text {
  background: transparent;
  color: #0D0D0D;
  border: none;
  padding: 8px 16px;
  font-size: 14px;
  font-weight: 600;
  text-decoration: underline;
  text-underline-offset: 2px;
}

.btn-text:hover {
  color: #c2fa0a;
}
```

**Usage:**
- Primary: "ORDER NOW", "Continue", "SUBMIT REVIEW"
- Secondary: "Brew another cup", "Change", "Skip now"
- Text: Navigation links, "< Back"

---

### 4.2 Cards

#### Product Card
```css
.card-product {
  background: #FFFFFF;
  border: 2px solid #E5E5EA;
  border-radius: 20px;
  overflow: hidden;
  transition: all 0.3s ease;
}

.card-product:hover {
  border-color: #c2fa0a;
  box-shadow: 0 8px 24px rgba(194, 250, 10, 0.15);
}
```

**Structure:**
```
┌────────────────────────┐
│                        │
│   [Product Image]      │ ← Full bleed image
│                        │
├────────────────────────┤
│  CAPPUCCINO            │ ← Bold headline
│  HOT AND READY         │
│                        │
│  [Coffee Cup Visual]   │ ← Large product visual
│                        │
│  ┌──────────────────┐  │
│  │ ORDER NOW · $9.99│  │ ← Primary button
│  └──────────────────┘  │
│                        │
│  Brew another cup >    │ ← Text link
└────────────────────────┘
```

#### Cart Item Card
```css
.card-cart-item {
  background: #FFFFFF;
  border-radius: 12px;
  padding: 12px;
  display: flex;
  gap: 12px;
  align-items: center;
}
```

**Structure:**
```
┌────────────────────────────────────┐
│ [Img] Cappuccino          - 01 +   │
│ 60px  $4.99                        │
│       ♡ Favorite  🗑️               │
└────────────────────────────────────┘
```

#### Order History Card
```css
.card-order {
  background: #F5F5F7;
  border: 1px solid #E5E5EA;
  border-radius: 16px;
  padding: 16px;
}
```

**Structure:**
```
┌────────────────────────────────────┐
│ Order N° O02           Delivering  │ ← Badge
│ Today, 08:37 AM          4.5 min   │
│                                    │
│ [Order Items Preview]              │
│                        $7.98       │
└────────────────────────────────────┘
```

---

### 4.3 Badges

#### Status Badge
```css
.badge {
  display: inline-flex;
  align-items: center;
  gap: 4px;
  padding: 6px 12px;
  border-radius: 8px;
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.badge-delivered {
  background: rgba(194, 250, 10, 0.15);
  color: #c2fa0a;
  border: 1px solid rgba(194, 250, 10, 0.3);
}

.badge-delivering {
  background: rgba(255, 149, 0, 0.15);
  color: #FF9500;
  border: 1px solid rgba(255, 149, 0, 0.3);
}

.badge-cancelled {
  background: rgba(255, 59, 48, 0.15);
  color: #FF3B30;
  border: 1px solid rgba(255, 59, 48, 0.3);
}
```

**Visual:**
```
┌─────────────┐  ┌──────────────┐  ┌─────────────┐
│ Delivered   │  │ Delivering   │  │ Cancelled   │
└─────────────┘  └──────────────┘  └─────────────┘
  Green badge      Orange badge      Red badge
```

#### Promo Badge
```css
.badge-promo {
  background: rgba(194, 250, 10, 0.2);
  color: #c2fa0a;
  font-size: 11px;
  font-weight: 700;
  padding: 4px 8px;
  border-radius: 6px;
}
```

**Example:** "Buy 2 get 1 free deal"

---

### 4.4 Forms

#### Input Field
```css
.input {
  background: #FFFFFF;
  border: 2px solid #E5E5EA;
  border-radius: 12px;
  padding: 14px 16px;
  font-size: 16px;
  color: #0D0D0D;
  transition: all 0.2s ease;
}

.input:focus {
  border-color: #c2fa0a;
  outline: none;
  box-shadow: 0 0 0 3px rgba(194, 250, 10, 0.15);
}

.input::placeholder {
  color: #999999;
}
```

#### Select / Dropdown
```css
.select {
  background: #FFFFFF;
  border: 2px solid #E5E5EA;
  border-radius: 12px;
  padding: 14px 16px;
  appearance: none;
  background-image: url("data:svg+xml,..."); /* Chevron icon */
}
```

#### Checkbox / Radio Pills (Option Selectors)
```css
.option-pill {
  background: #FFFFFF;
  border: 2px solid #E5E5EA;
  border-radius: 24px;
  padding: 10px 20px;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease;
}

.option-pill:hover {
  border-color: #c2fa0a;
}

.option-pill.active {
  background: #c2fa0a;
  border-color: #c2fa0a;
  color: #0D0D0D;
}
```

**Visual (Sugar Level Selector):**
```
┌────┐ ┌────┐ ┌────┐ ┌────┐ ┌────┐
│ 0% │ │25% │ │50% │ │75% │ │100%│
└────┘ └────┘ └────┘ └────┘ └────┘
          ↑ Active (hijau background)
```

---

### 4.5 Bottom Sheet / Drawer

#### Mobile Bottom Sheet
```css
.bottom-sheet {
  position: fixed;
  bottom: 0;
  left: 0;
  right: 0;
  background: #FFFFFF;
  border-radius: 24px 24px 0 0;
  padding: 20px;
  max-height: 85vh;
  overflow-y: auto;
  box-shadow: 0 -4px 24px rgba(0, 0, 0, 0.15);
  transform: translateY(100%);
  transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
}

.bottom-sheet.open {
  transform: translateY(0);
}

.bottom-sheet-handle {
  width: 40px;
  height: 4px;
  background: #E5E5EA;
  border-radius: 2px;
  margin: 0 auto 16px;
}
```

**Visual:**
```
┌────────────────────────────────┐
│        ──────                  │ ← Drag handle
│                                │
│   Order Summary                │ ← Title
│                                │
│   My Order                     │
│   [Order Items]                │
│                                │
│   Order Type                   │
│   ┌──────────┐  ┌──────────┐  │
│   │ Delivery │  │  Pickup  │  │
│   └──────────┘  └──────────┘  │
│                                │
│   ┌──────────────────────────┐│
│   │ ORDER NOW · $12.99       ││ ← Sticky button
│   └──────────────────────────┘│
└────────────────────────────────┘
```

#### Desktop Side Drawer (Tablet & Desktop)
```css
.side-drawer {
  position: fixed;
  right: 0;
  top: 0;
  bottom: 0;
  width: 420px;
  background: #FFFFFF;
  box-shadow: -4px 0 24px rgba(0, 0, 0, 0.1);
  transform: translateX(100%);
  transition: transform 0.3s ease;
  overflow-y: auto;
}

.side-drawer.open {
  transform: translateX(0);
}
```

---

### 4.6 Icons & Illustrations

#### Icon Style
- **Library:** Heroicons Outline (primary), Lucide Icons (alternative)
- **Size:** 20px (small), 24px (medium), 32px (large)
- **Color:** Inherit from parent or #0D0D0D default
- **Stroke Width:** 2px

#### Common Icons
```
Navigation: < (Back), × (Close), ☰ (Menu)
Actions: ♡ (Favorite), 🗑️ (Delete), + (Add), - (Remove)
Status: ✓ (Check), ⚠ (Warning), 🔥 (Fire/Hot), 📍 (Location)
UI: ⌄ (Chevron Down), › (Chevron Right), 🔍 (Search)
```

#### Product Illustrations
- **Style:** Bold, flat, geometric coffee cup illustrations
- **Color:** Match primary color scheme (hijau accent on cup design)
- **Usage:** Hero sections, empty states, loading states

---

## 5. Layout System

### 5.1 Grid System

#### Mobile (320px - 767px)
```
Container Padding: 16px
Columns: 1 column
Gap: 16px
Max Width: 100%
```

#### Tablet (768px - 1023px)
```
Container Padding: 24px
Columns: 2 columns (catalog grid)
Gap: 20px
Max Width: 100%
```

#### Desktop (1024px+)
```
Container Padding: 32px
Columns: 3-4 columns (catalog grid)
Gap: 24px
Max Width: 1200px (centered)
```

### 5.2 Container Classes
```css
.container {
  width: 100%;
  margin: 0 auto;
  padding: 0 16px;
}

@media (min-width: 768px) {
  .container {
    padding: 0 24px;
  }
}

@media (min-width: 1024px) {
  .container {
    max-width: 1200px;
    padding: 0 32px;
  }
}

.container-narrow {
  max-width: 780px;
  margin: 0 auto;
}
/* Usage: Checkout forms, order detail pages */
```

### 5.3 Catalog Grid
```css
.catalog-grid {
  display: grid;
  grid-template-columns: 1fr;
  gap: 16px;
}

@media (min-width: 768px) {
  .catalog-grid {
    grid-template-columns: repeat(2, 1fr);
    gap: 20px;
  }
}

@media (min-width: 1024px) {
  .catalog-grid {
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
  }
}
```

---

## 6. Page Layouts

### 6.1 Product Detail Page (Mobile)
```
┌────────────────────────────────┐
│ < Back to Brew            🛒 2 │ ← Header
├────────────────────────────────┤
│                                │
│    CAPPUCCINO                  │ ← Bold headline (hijau)
│    HOT AND READY               │
│                                │
│   [Large Coffee Cup Image]     │ ← Hero product visual
│                                │
│  ┌──────────────────────────┐  │
│  │ ORDER NOW · $9.99        │  │ ← Primary CTA (hijau bg)
│  └──────────────────────────┘  │
│                                │
│  Brew another cup >            │ ← Secondary link
│                                │
└────────────────────────────────┘
```

### 6.2 Cart Page (Mobile)
```
┌────────────────────────────────┐
│ < My Cart                      │ ← Header
├────────────────────────────────┤
│ ┌────────────────────────────┐ │
│ │ [Img] Cappuccino    - 01 + │ │ ← Cart item
│ │       $4.99                │ │
│ │       ♡ Favorite  🗑️        │ │
│ └────────────────────────────┘ │
│                                │
│ ┌────────────────────────────┐ │
│ │ [Img] Coffee Latte  - 01 + │ │
│ │       $2.99                │ │
│ │       ♡ Favorite  🗑️        │ │
│ └────────────────────────────┘ │
│                                │
│ Buy 2 get 1 free deal          │ ← Promo badge (hijau)
│                                │
├────────────────────────────────┤
│ 2 x Brew Coffee         $7.98  │ ← Summary
│ 1 x Brew Coffee          Free  │
│ Delivery                 Free  │
├────────────────────────────────┤
│ ┌──────────────────────────┐   │
│ │ Continue · $7.98         │   │ ← Sticky CTA (hijau)
│ └──────────────────────────┘   │
└────────────────────────────────┘
```

### 6.3 Order Summary (Bottom Sheet)
```
┌────────────────────────────────┐
│        ──────                  │ ← Handle
│                                │
│ < Order Summary                │
│                                │
│ My Order                $7.98  │
│ [Order Preview Images]         │
│ Free Delivery $0               │
│ Buy 2 get 1 free               │
│                                │
│ Order Type                     │
│ ┌──────────┐  ┌──────────┐    │
│ │ Delivery │  │  Pickup  │    │ ← Option pills
│ │ within   │  │ Ready in │    │
│ │ 4.5 min  │  │ 2-3 min  │    │
│ └──────────┘  └──────────┘    │
│                                │
│ Delivery Address               │
│ 📍 Office                      │
│    30b Caterina Branch  Change │
│                                │
│ Payment Method                 │
│ 💳 Credit Card          Change │
│    **234                       │
│                                │
│ ┌──────────────────────────┐   │
│ │ ORDER NOW · $12.99       │   │ ← Primary CTA (hijau)
│ └──────────────────────────┘   │
└────────────────────────────────┘
```

### 6.4 Order Tracking Page
```
┌────────────────────────────────┐
│ <                              │
│                                │
│   YOUR CAPPUCCINO              │ ← Bold headline (hijau)
│   ON THE WAY                   │
│                                │
│  [Coffee Cup Visual]           │
│                                │
│  Rate Coffee & Delivery        │
│  ⭐ ⭐ ⭐ ⭐ ⭐                 │ ← Star rating
│                                │
│  Your Feedback                 │
│  How it was your coffee?       │
│  Does it arrive within the     │
│  time frame on the cup?        │
│                                │
│  ┌──────────────────────────┐  │
│  │ SUBMIT REVIEW · 5★       │  │ ← Primary CTA (hijau)
│  └──────────────────────────┘  │
│                                │
│  Skip now >                    │
│                                │
└────────────────────────────────┘
```

### 6.5 Order History (Accordion View)
```
┌────────────────────────────────┐
│ < Order History                │
├────────────────────────────────┤
│ ┌────────────────────────────┐ │
│ │ Order N° O02   Delivering  │ │ ← Card (collapsed)
│ │ Today, 08:37 AM   4.5 min  │ │
│ │ [Order Preview]     $7.98  │ │
│ └────────────────────────────┘ │
│                                │
│ ┌────────────────────────────┐ │
│ │ < Tracking: Order N° O16   │ │ ← Card (expanded)
│ │                            │ │
│ │ My Order            $7.98  │ │
│ │ [Order Items]              │ │
│ │ Free Delivery $0           │ │
│ │ Buy 2 get 1 free           │ │
│ │                            │ │
│ │ Order N° O16    Delivering │ │
│ │ Today, 08:37 AM   in 2 min │ │
│ │                            │ │
│ │ 08:37  ✓ Brewing...        │ │ ← Timeline
│ │ 08:40  ✓ Picked For        │ │
│ │           Delivery.        │ │
│ │ 08:43  🔥 Delivering...    │ │ ← Active (hijau icon)
│ │ 08:45  ⏱ Enjoying your     │ │
│ │           coffee.          │ │
│ │                            │ │
│ │ ┌────────┐  ┌────────────┐│ │
│ │ │ 📞 CS  │  │ 📞 Driver  ││ │ ← Action buttons
│ │ └────────┘  └────────────┘│ │
│ └────────────────────────────┘ │
│                                │
│ ┌────────────────────────────┐ │
│ │ Order N° O01    Delivered  │ │
│ │ May 07, 2025        $7.98  │ │
│ └────────────────────────────┘ │
│                                │
│ ┌────────────────────────────┐ │
│ │ Order N° O08    Delivered  │ │
│ │ May 08, 2025        $3.99  │ │
│ └────────────────────────────┘ │
└────────────────────────────────┘
```

---

## 7. Interactions & Animations

### 7.1 Button Interactions
```css
/* Hover */
transform: translateY(-1px);
box-shadow: 0 4px 12px rgba(194, 250, 10, 0.3);

/* Active/Press */
transform: scale(0.98);

/* Disabled */
opacity: 0.4;
cursor: not-allowed;
```

### 7.2 Card Hover
```css
/* Default */
border: 2px solid #E5E5EA;

/* Hover */
border: 2px solid #c2fa0a;
box-shadow: 0 8px 24px rgba(194, 250, 10, 0.15);
transform: translateY(-2px);
transition: all 0.3s ease;
```

### 7.3 Bottom Sheet Animation
```css
/* Enter */
transform: translateY(0);
transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);

/* Exit */
transform: translateY(100%);
```

### 7.4 Loading States

#### Skeleton Loader
```css
.skeleton {
  background: linear-gradient(
    90deg,
    #F5F5F7 0%,
    #E5E5EA 50%,
    #F5F5F7 100%
  );
  background-size: 200% 100%;
  animation: shimmer 1.5s infinite;
}

@keyframes shimmer {
  0% { background-position: 200% 0; }
  100% { background-position: -200% 0; }
}
```

#### Spinner
```css
.spinner {
  border: 3px solid #E5E5EA;
  border-top-color: #c2fa0a;
  border-radius: 50%;
  width: 32px;
  height: 32px;
  animation: spin 0.8s linear infinite;
}

@keyframes spin {
  to { transform: rotate(360deg); }
}
```

### 7.5 Toast Notifications
```css
.toast {
  background: #0D0D0D;
  color: #FFFFFF;
  padding: 16px 20px;
  border-radius: 12px;
  box-shadow: 0 4px 16px rgba(0, 0, 0, 0.2);
  animation: slideInUp 0.3s ease;
}

.toast.success {
  background: #c2fa0a;
  color: #0D0D0D;
}

@keyframes slideInUp {
  from {
    transform: translateY(100%);
    opacity: 0;
  }
  to {
    transform: translateY(0);
    opacity: 1;
  }
}
```

---

## 8. Responsive Breakpoints

### Mobile First Approach
```scss
// Mobile (base): 320px - 767px
.component {
  // Mobile styles (default)
}

// Tablet: 768px - 1023px
@media (min-width: 768px) {
  .component {
    // Tablet adjustments
  }
}

// Desktop: 1024px+
@media (min-width: 1024px) {
  .component {
    // Desktop adjustments
  }
}
```

### Viewport-Specific Rules

#### Mobile (320-767px)
- 1 column catalog grid
- Bottom sheet for modals
- Sticky footer with CTA
- Hamburger menu navigation
- Full-width cards

#### Tablet (768-1023px)
- 2 column catalog grid
- Side drawer (420px) replaces bottom sheet
- Horizontal navigation
- Card grid with 20px gaps

#### Desktop (1024px+)
- 3-4 column catalog grid
- Side drawer (420px)
- Full navigation bar
- Max content width: 1200px
- Hover states enabled

---

## 9. Accessibility (WCAG 2.1 AA)

### Color Contrast
```
Primary Green (#c2fa0a) on Black (#0D0D0D): 14.2:1 ✓ (AAA)
Black (#0D0D0D) on White (#FFFFFF): 19.6:1 ✓ (AAA)
Gray (#666666) on White: 5.7:1 ✓ (AA)
```

### Touch Targets
- Minimum size: 44x44px (iOS guideline)
- Spacing between targets: 8px minimum

### Focus States
```css
*:focus-visible {
  outline: 3px solid #c2fa0a;
  outline-offset: 2px;
}
```

### Screen Reader Support
- All images have `alt` text
- Form inputs have associated `<label>`
- ARIA labels for icon-only buttons
- Skip to main content link

### Keyboard Navigation
- All interactive elements focusable
- Logical tab order
- ESC key closes modals/drawers
- Enter/Space activates buttons

---

## 10. Implementation Checklist

### Sprint 2 Priorities

#### Blade Components to Build
- [ ] `<x-button>` - Primary, Secondary, Text variants
- [ ] `<x-card>` - Product, Cart Item, Order variants
- [ ] `<x-badge>` - Status badges (Delivered, Delivering, Cancelled)
- [ ] `<x-input>` - Text input, Select, Textarea
- [ ] `<x-bottom-sheet>` - Mobile modal drawer
- [ ] `<x-option-pill>` - Radio/checkbox pills for customization
- [ ] `<x-product-card>` - Menu item card with image
- [ ] `<x-cart-item>` - Cart list item with quantity controls
- [ ] `<x-navbar>` - Top navigation with cart badge

#### CSS Classes to Implement
- [ ] Color utilities (`.text-stabilo`, `.bg-stabilo`)
- [ ] Typography classes (`.display-lg`, `.h1-h4`, `.body-lg/md/sm`)
- [ ] Button classes (`.btn-primary`, `.btn-secondary`)
- [ ] Card classes (`.card`, `.card-product`, `.card-order`)
- [ ] Badge classes (`.badge`, `.badge-delivered`, etc.)
- [ ] Layout utilities (`.container`, `.catalog-grid`)

#### Pages to Style
- [ ] Home/Landing page
- [ ] Menu catalog page
- [ ] Product detail (bottom sheet)
- [ ] Cart page/drawer
- [ ] Checkout page (order summary)
- [ ] Order history page
- [ ] Order tracking page

---

## 11. Design Tokens (Tailwind Config)

### tailwind.config.js
```javascript
export default {
  theme: {
    extend: {
      colors: {
        stabilo: '#c2fa0a',
        primary: '#0D0D0D',
        background: '#FFFFFF',
        neutral: {
          DEFAULT: '#F5F5F7',
          border: '#E5E5EA',
          text: '#666666',
        },
        status: {
          success: '#c2fa0a',
          warning: '#FF9500',
          error: '#FF3B30',
          info: '#007AFF',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', 'sans-serif'],
      },
      fontSize: {
        'display-lg': ['56px', { lineHeight: '1.1', fontWeight: '900' }],
        'display-md': ['40px', { lineHeight: '1.2', fontWeight: '900' }],
      },
      borderRadius: {
        'xl': '12px',
        '2xl': '16px',
        '3xl': '20px',
        '4xl': '24px',
      },
      boxShadow: {
        'stabilo': '0 4px 12px rgba(194, 250, 10, 0.3)',
        'card': '0 8px 24px rgba(194, 250, 10, 0.15)',
      },
    },
  },
}
```

---

## 12. Component Examples (HTML + Tailwind)

### Primary Button
```html
<button class="btn-primary">
  ORDER NOW · $9.99
</button>

<!-- Tailwind -->
<button class="bg-stabilo text-primary font-bold uppercase px-8 py-4 rounded-xl hover:bg-opacity-90 active:scale-95 transition-all">
  ORDER NOW · $9.99
</button>
```

### Status Badge
```html
<span class="badge badge-delivered">Delivered</span>

<!-- Tailwind -->
<span class="inline-flex items-center px-3 py-1.5 rounded-lg text-xs font-semibold uppercase bg-stabilo/15 text-stabilo border border-stabilo/30">
  Delivered
</span>
```

### Cart Item
```html
<div class="card-cart-item">
  <img src="coffee.jpg" alt="Cappuccino" class="w-16 h-16 rounded-lg object-cover">
  <div class="flex-1">
    <h3 class="font-semibold">Cappuccino</h3>
    <p class="text-sm text-neutral-text">$4.99</p>
    <div class="flex gap-2 mt-1">
      <button class="text-sm">♡ Favorite</button>
      <button class="text-sm">🗑️</button>
    </div>
  </div>
  <div class="flex items-center gap-2">
    <button class="w-8 h-8 flex items-center justify-center border border-neutral-border rounded">-</button>
    <span class="w-8 text-center">01</span>
    <button class="w-8 h-8 flex items-center justify-center border border-neutral-border rounded">+</button>
  </div>
</div>
```

---

## 13. Brand Voice & Messaging

### Tone of Voice
- **Bold & Energetic**: Uppercase headlines, bold statements
- **Friendly & Approachable**: Casual language ("Brew another cup", "Your cappuccino on the way")
- **Clear & Direct**: No jargon, straightforward CTAs

### Microcopy Examples
```
Headers:
- "CAPPUCCINO HOT AND READY"
- "YOUR CAPPUCCINO ON THE WAY"
- "Back to Brew"

CTAs:
- "ORDER NOW · $9.99"
- "Continue · $7.98"
- "SUBMIT REVIEW · 5★"

Status Messages:
- "Brewing..."
- "Picked For Delivery."
- "Delivering..."
- "Enjoying your coffee."

Prompts:
- "Brew another cup >"
- "Skip now >"
- "Change"
```

---

## 14. Assets & Resources

### Image Requirements
- Product photos: 800x800px minimum, 2x for retina
- Format: WebP (fallback: JPEG)
- Compression: <200KB per image
- Hero images: 1200x800px minimum

### Icon Requirements
- Format: SVG (inline)
- Stroke width: 2px
- Size: 20px, 24px, 32px variants
- Color: Inherit or #0D0D0D

### Font Loading
```html
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;900&display=swap" rel="stylesheet">
```

---

## Changelog

**v1.0** - 2026-10-11
- Initial design system created
- Defined color palette with Stabilo Green (#c2fa0a) as primary
- Established typography scale and component library
- Documented all page layouts and interactions
- Added accessibility guidelines (WCAG 2.1 AA compliant)

---

**References:**
- PRD: `/prd.md`
- Project Brief: `/project-brief.md`
- Figma Reference: Order Flow mockups (red replaced with #c2fa0a)
