# Data Versioning Strategy: Product vs. Project

This document outlines the architectural reasoning behind the distinct data management strategies for **Products** (Explicit Versioning) and **Projects** (Snapshotting).

## 1. Strategy Overview

| Entity | Strategy | Mechanism |
| :--- | :--- | :--- |
| **Product (Price)** | **Explicit Versioning** | `product_price_versions` table maintains history. |
| **Project (Name)** | **Snapshotting** | `invoices` table copies `project_name` at creation. |

---

## 2. Product Pricing: Why Explicit Versioning?

**Business Context:**
Pricing is a **Variable Business Strategy**, not just static data. Prices fluctuate based on market conditions, inflation, or sales periods.

**Rationale for Versioning:**
1.  **Analytics & Trend Analysis:**
    *   *Question:* "How has our margin for 'Item A' evolved from 2023 to 2024?"
    *   *Requirement:* We must retain historical price data to analyze cost vs. revenue trends over time. Overwriting prices destroys this analytical value.
2.  **Grandfathering & Validity:**
    *   *Scenario:* A contract signed in 2023 uses the 2023 price list.
    *   *Requirement:* Old versions remain **valid options**. A user might intentionally select a legacy price version for a specific deal. The old data is not "incorrect," it is simply "past valid."

---

## 3. Project Identity: Why Snapshotting?

**Business Context:**
Project attributes (Name, Description) serve as **Identity Labels**. Changes are typically corrections or status updates, not strategic shifts.

**Rationale for Snapshotting:**
1.  **Audit Trail/Integrity:**
    *   *Scenario:* An Invoice was issued for "Gudang Cikarang". The Project is later renamed to "Gudang Cikarang Barat" (Correction).
    *   *Requirement:* The issued Invoice must **forever** read "Gudang Cikarang" to match the printed document sent to the client.
2.  **Correction vs. Variation:**
    *   *Reasoning:* When a project name is updated, the previous name is usually considered a "typo" or "outdated status." It has no analytical value. No one analyzes "Trends in Project Typos."
    *   *Implementation:* Storing the `project_name` as a text snapshot on the `invoices` table preserves the *state at transaction time* without the complexity of maintaining a version history table.

---

## Summary
*   **Use Versioning** when the history of changes has business value or financial implications **(e.g., Prices, Tax Rates).**
*   **Use Snapshotting** when the goal is purely data integrity for audit trails **(e.g., Project Names, Addresses on Invoices).**
