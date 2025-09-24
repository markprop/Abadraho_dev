# Housing Budget Calculator — Implementation Summary

## Overview
We upgraded the calculator inside `resources/views/projects/partials/housing_calculator.blade.php` with accurate, real‑time calculations and non‑intrusive UI improvements while keeping the existing markup and styling intact.

## What Changed (Accurate to Code)

- Real‑time total updates for both tabs (FLAT and CONSTRUCTION) using a compact inline script.
- Currency formatting: all numeric inputs auto‑format with commas as you type; display total shows as `Rs. 1,234,567`.
- Possession Fee is optional; empty/invalid → treated as 0.
- Duration parsing from existing selects (`#duration_month_flat` / `#duration_month`).
- Construction additions: `Slab Casting + Plinth + Colour` are summed and included only when the CONSTRUCTION tab is active.
- Split Down Payment:
  - When checked, the four fields (Booking, Allocation, Confirmation, Start of Work) are shown.
  - Their live sum disables and populates the main Down Payment field (read‑only while checked).
  - When unchecked, the Down Payment field becomes editable again.
- Independent totals per tab; switching tabs recalculates the active form.
- Debounced recalculation to avoid excessive work during fast typing.

## Formula Used

For a selected tab’s form:

Total Budget = Down Payment
            + (Monthly × months)
            + (Quarterly ÷ 3 × months)
            + (Half‑Yearly ÷ 6 × months)
            + (Yearly ÷ 12 × months)
            + Possession
            + ConstructionExtras  (only on CONSTRUCTION tab: Slab + Plinth + Colour)

Notes:
- Each installment is included only if its field has a valid number > 0.
- Possession is optional and included only if > 0.
- When Split Down Payment is checked, Down Payment = sum of the four split fields.

## Key Implementation Details

- Inline JS listens to `input`/`change` on all relevant inputs and to Bootstrap tab switch events.
- Inputs are switched to `type="text"` at runtime (with `inputmode="decimal"`) to allow comma formatting; values are sanitized to numbers for calculations.
- Hidden `#maxBudgetFlat` / `#maxBudgetConstruction` are kept in sync with the rounded numeric total for form submissions.

## Files Touched

- `resources/views/projects/partials/housing_calculator.blade.php` — labels added, split DP sections toggled, and inline JS for logic/formatting.
- Several layout/view files received minor label additions only; no styling changes.

## Future Enhancements (Not Implemented Yet)

- Enforce that split fields’ sum must equal the original Down Payment when toggled on.
- Optional inline validation messages next to fields.
- Unit tests around calculation scenarios.

## Usage

Open the calculator and start typing; the “My Budget” amount updates instantly. Use the Split Down Payment checkbox if you want to break down the down payment into four parts.
