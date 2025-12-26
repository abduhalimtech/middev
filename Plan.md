### Rule 1: 70/30

Every day:

* **70% new tasks**
* **30% re-solves** (redo old tasks from scratch with a timer)

This is what stops forgetting.

### Rule 2: No-AI during solving

AI is only allowed for **creating the test packs ahead of time** (today).
While training: **no AI**, only php.net docs.

### Rule 3: Every task uses the same 4-step workflow

Timebox hard:

1. **Read tests (max 3 min)** → write 4 bullets (valid/invalid/output/special rule)
2. **Implement dumb version (max 12–15 min)** (foreach + if/continue)
3. **Fix failures (max 7–10 min)** (one failing assertion at a time)
4. **Lock it in (2 min)**: write 1 line in notebook: “edge case + pattern”

If you’re stuck >5 minutes on one failing case: **skip and come back**.

---

## What you should practice (the “task bank”)

You do NOT need external kata sites to pass. You need **variations of the same patterns**:

### Arrays patterns (you’ll see these again)

* smallest / second smallest / min-max-stats
* delete first/last (array & string variants)
* normalize values (valid ints only) + unique + sort + sum
* pluck unique non-empty strings (preserve order)
* group by key / stable sort by key

### Dates patterns

* isWeekend
* nextMondayIfWeekend
* addDaysSkippingHolidays
* nextBusinessDay / shiftToBusinessDayAtNine
* addBusinessDays (+ and -)

### Strings patterns

* delete first/last char
* normalize spaces / slugify
* extract between markers
* validate shape (email-like)
* regex extract (hashtags etc.)

---

# 7-day schedule (fits your hours)

## Day 1 (5–8h): Build your “speed base”

**Goal:** solve **12 tasks** (not perfect code, just passing tests)

* **Block 1 (90 min)** Arrays: 4 tasks
* **Block 2 (90 min)** Strings: 4 tasks
* **Block 3 (90 min)** Dates: 3 tasks
* **Block 4 (45–60 min)** Re-solve 2 tasks from earlier today (timer 12 min each)

Notebook today:

* Create 1 page called **“Edge case checklist”** and write:
  `empty input`, `single`, `duplicates`, `mixed types`, `whitespace`, `invalid date`, `weekend+holiday chain`, `timezone`

---

## Day 2 (5–8h): Edge-case discipline

**Goal:** another **12 tasks** + fix your weak spots

Same blocks as Day 1, but add this rule:

* After you pass a task, immediately add **1 extra assertion** in tests (edge case you forgot) and rerun.

Re-solve: **3 tasks** (10–12 min each)

---

## Day 3 (5–8h): Mock interview #1 + targeted drilling

**Goal:** learn time control

* **Mock 60 minutes (no AI):** solve as many tasks as possible.
* **After mock (2–3h):** redo every task you failed, but one by one.

Then do:

* Arrays: 3 tasks
* Dates: 3 tasks (dates every day from now on)

---

## Day 4 (5–8h): Dates heavy day (this is where mid interviews filter people)

**Goal:** **8 date tasks + 4 mixed tasks**

* Dates: shift-to-business-day, add-business-days (+/-), skip holidays chain, set time to 09:00, month boundaries
* Arrays: 2 tasks
* Strings: 2 tasks
* Re-solve: 3 tasks total (one from each folder)

---

## Day 5 (5–8h): Mock interview #2 + “skip skill”

**Goal:** stop wasting time on one task

* **Mock 60 minutes** with skip rules:

  * If stuck >5 minutes → skip, move on.
* **Post-mock:** fix failures

Then do:

* 6 new tasks (2 per folder)
* Re-solve: 4 tasks (short timer)

---

## Day 6 (3–4h): Consolidation day

**Goal:** turn patterns into reflex

* Re-solve **10 tasks** (not new)
  Timer: **8–10 minutes per task**
* Focus on the exact patterns you described from the interview:

  * smallest int with mixed inputs
  * delete first/last
  * normalize unique sorted sum
  * pluck unique non-empty
  * shift business day at nine / skipping holidays

---

## Day 7 (3–4h): Final rehearsal (the day before)

**Goal:** confidence + speed

* **Mock 60 minutes** one last time
* Then only review:

  * your notebook “Mistake log”
  * re-solve **3 weakest tasks**

No new tasks today.

---

# How many tasks you should complete

With your time, a good target is:

* **New tasks:** ~45–60
* **Re-solves:** ~25–40
  Total “solves”: **70–100**

That’s exactly what turns this into “easy and fast”.

---

