# Block Scholar — Portfolio Case Study

> **Fill in before publishing:** the bracketed fields below (`[ ... ]`) need your real input — team member names/roles and your specific contributions. Everything else reflects what's actually in the codebase and in this engagement's changes; nothing here is invented.

## What it is

Block Scholar is a Laravel 10 web application demonstrating a scholarship-distribution workflow: students apply to scholarships listed by organizations/providers, providers review and approve applications, and approved disbursements are recorded as a blockchain transaction on the Ethereum Sepolia **test** network. It is an academic/portfolio project, not a live scholarship program.

**Stack:** PHP 8.2 / Laravel 10, MySQL, Bootstrap 4, jQuery, ethers.js v6 (client-side wallet signing), Vite (asset pipeline), PHPUnit.

## Team & Attribution

- Team: `[list team members and roles, or "solo project" — you told me it was a team project but I don't have the roster]`
- My specific contributions: `[fill in — e.g. "I built the blockchain disbursement flow and the org review dashboard" / "I owned the database schema and the auth flow" — be as specific as the work actually was]`

This section must be accurate before this document is published anywhere. An AI assistant (this engagement) performed a separate, later hardening/rebuild pass described below — that work should be attributed to the assistant-assisted session, not folded into the original team's original contributions.

## What this engagement changed

Working from the existing codebase (not a rewrite), this session:

**Security**
- Found and fixed two IDOR vulnerabilities: an org account could view another org's applicant reviews and full student profiles by guessing sequential IDs in the URL (`OrgReviewApplicantController`, `OrgViewStudentFullInfoController`).
- Found and removed a private key that was being injected server-side into client-facing JavaScript (`org/review.blade.php` + `send2.js`) — if ever configured, this would have leaked a wallet's private key to every organization user's browser.
- Found that applicant-uploaded files (requirement PDFs, profile photos, report-card images) were stored directly in the public web root with timestamp-based filenames, making them enumerable/downloadable by anyone. Rebuilt file storage to use non-public storage served only through an ownership-checked route (`SecureFileController`).
- Added a `role` route middleware so dashboard routes are protected at the routing layer instead of relying solely on a per-controller session check repeated (inconsistently) in every action.
- Added login rate limiting, a security-headers middleware, a unique DB constraint on `users.email`, and server-side validation (`FormRequest` classes) where none existed before.
- Closed a data-integrity gap in blockchain disbursement recording: the server previously trusted a client-reported transaction hash/amount with no on-chain check. It now verifies the transaction receipt against the configured RPC node before marking a disbursement `chainVerified`, and surfaces that status in the UI.

**Correctness**
- Resolved a three-way contradiction in the minimum account age (signup allowed 14+, Terms said 18+, Privacy said 13+) down to a single enforced rule (18+), applied at registration and consistently described in Terms/Privacy.
- Found that `vwapplications` and `vwtransactions` — SQL views several controllers depend on — were never created by a Laravel migration, only by a one-time manual import of `scholardb.sql`. A fresh `php artisan migrate` (new environment, CI, or this session's own test suite) would have left those pages broken. Added migrations that create both views portably (MySQL and SQLite).
- Fixed a bug where editing an unrelated profile field silently wiped a student's previously uploaded profile photo/grade image.

**Product surface**
- Replaced the signup modal with a dedicated `/register` page: role chosen first (Student vs Organization/Provider), role-appropriate fields (an organization is no longer asked for a birth date/gender), a corrected Last Name field, password policy + confirmation + visibility toggle, unchecked Terms/Privacy acceptance, accessible error handling.
- Added a public, unauthenticated showcase: scholarship catalog and detail pages (real eligibility/deadline data), a "How It Works" page (roles, a sample application-status timeline matching the actual status values in the code, and an honest on-chain-vs-off-chain breakdown), and a branded 404 page.
- Rewrote Privacy Policy and Terms & Conditions to describe what the system actually collects, stores, and does — replacing generated boilerplate that referenced a domain the project doesn't own and claims ("encrypted, tamper-proof" blockchain records) the code didn't support.
- Fixed all dead/placeholder navigation (`class.html`, `contact.html`, empty `href`s, `href="#"` placeholders), removed several fully orphaned modals and dead JavaScript left over from earlier iterations, and removed unused legacy libraries (isotope, owlCarousel, lightbox, flaticon, pdf.js) after confirming via the actual markup and `main.js` that nothing used them.
- Modernized the landing page: fixed heading hierarchy (was skipping/reordering h1–h4), restrained the handwritten accent font to a single wordmark class instead of every heading site-wide, fixed color contrast issues, and added meaningful alt text to content-bearing images (swapped a stock photo of loose cryptocurrency coins for an actual classroom photo on the "About" section, and removed a stock photo of children in copyrighted superhero costumes that was in the image library).
- Added unique per-page titles/descriptions, canonical tags, Open Graph/Twitter metadata, a social preview image, `robots.txt`, and `sitemap.xml`, replacing "Free HTML Templates" placeholder metadata across every page.

## Notable technical decisions

- **Blockchain scope, stated plainly:** the disbursement transfer itself happens on-chain (Ethereum Sepolia testnet); every field of applicant PII stays in the relational database. This is a deliberate choice, documented on `/how-it-works`, not an accidental limitation — public blockchains are the wrong place for personal data.
- **Additive migrations only:** every schema change in this engagement is additive/nullable (new columns, new views, a new unique index guarded by a duplicate check) — none of it required or performed a destructive migration against the project's real data.
- **Legacy asset removal was usage-verified, not guessed:** before deleting a script or stylesheet, its actual call sites were traced in `main.js` and cross-checked against the compiled markup for the classes/ids it targets, to avoid removing something silently load-bearing.

## Known limitations (documented, not hidden)

- The wallet-signing flow (`ethers.JsonRpcProvider(...).getSigner()`) assumes an RPC endpoint with unlocked accounts (e.g. a local Hardhat node), consistent with a testnet/academic demo. A production deployment would need a real wallet-connect flow (e.g. `ethers.BrowserProvider(window.ethereum)`).
- No smart contract source or verified explorer link ships with this instance because none is currently deployed for it; the ABI is loaded from local config only.
- Several dashboard pages likely have their own small pockets of copy-pasted, unused UI (a pattern found and removed in at least four files) that a broader audit would probably still turn up more of.
- The Vite build pipeline (`npm run build`) produces output no view actually loads via `@vite` — the site's real CSS/JS lives in `public/`. Left in place rather than removed, since ripping out a build pipeline is a bigger call than a hardening pass should make unilaterally.
