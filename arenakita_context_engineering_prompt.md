# Context Engineering: ArenaKita (Badminton Court Reservation System)

## 1. Brand Identity & Design Philosophy
*   **Product Name:** ArenaKita
*   **Design Theme:** "Calm & Elegant Sporty"
*   **Visual Direction:** High-trust, premium aesthetic inspired by modern hotel booking platforms.
*   **Color Palette:**
    *   **Navy Blue:** Primary color for authority and elegance.
    *   **Emerald/Sage Green:** Action color for bookings and positive statuses (e.g., bg-emerald-500).
    *   **Destructive Red:** Used for cancellations and critical warnings.
    *   **Off-White/Clean Backgrounds:** Focus on whitespace and typography for readability.
*   **Typography:** Modern sans-serif (Inter/Plus Jakarta Sans) with clear hierarchy and generous tracking.
*   **Aesthetics:** Sharp borders (low roundness), subtle shadows, and a complete avoidance of busy patterns (like batik) to maintain a professional, focused sports atmosphere.

## 2. Target Users & Access Control
*   **Renter (Penyewa):** End-users who search for courts, book time slots, and manage their personal booking history.
*   **Admin:** Managers who oversee user verification, venue maintenance, payment validation, and business analytics.

## 3. Core Functionality & User Flows
*   **Onboarding:** Strict account verification flow (Register -> Pending State -> Admin Approval -> Active Access).
*   **Booking Engine:** 
    *   Grid-based venue catalog (2-3 cards per row).
    *   Time-range booking (Min: 1 hour, Max: 3 hours, 30-minute increments).
    *   Advanced availability filters (Date/Time pickers similar to hospitality apps).
*   **Payment Flow:** Manual bank transfer with a "Detail & Upload Proof" screen. Features a "Konfirmasi Pemesanan" (Green) and "Batalkan Pesanan" (Red) dual-action system.
*   **Admin Management:**
    *   **User Management:** Approving/Rejecting new registrations.
    *   **Venue Management:** CRUD operations for courts, including status toggles (Available, Maintenance, Occupied).
    *   **Booking & Payment Verification:** Validating manual payment proofs against system records.
    *   **Dashboard:** High-level analytics on revenue and occupancy.

## 4. Technical Constraints (Frontend)
*   **Framework:** Pure HTML & Tailwind CSS.
*   **Layout:** Consistent container margins across all pages (aligned with the Court Catalog layout).
*   **Navigation:** Consistent top navbar for renters featuring: "Beranda" (Home), "Lapangan" (Courts), and "Riwayat Pemesanan" (Booking History), plus a profile Avatar icon and Notification icon.
*   **Consistency:** Every new screen must inherit the specific padding, font scales, and button styles established in the "Premium Booking Style" iteration.
