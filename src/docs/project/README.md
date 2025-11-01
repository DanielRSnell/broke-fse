# Project Context Directory

## Overview

This directory serves as the **AI context layer** for your project—a single source of truth that gives LLMs (Large Language Models like Claude, GPT-4, etc.) comprehensive understanding of your project's requirements, brand, content, and constraints.

Think of this as **persistent memory** for AI assistants. Instead of re-explaining your brand voice, technical requirements, or content guidelines in every conversation, you document them once here and reference them when needed.

---

## Philosophy

### The Problem This Solves

When working with AI tools on content, design, or development tasks, you typically face these challenges:

- **Repetitive context setting** - Explaining the same brand guidelines in every conversation
- **Inconsistent output** - AI generates content that doesn't match your established voice
- **Hallucinated information** - AI invents fake experience, credentials, or achievements
- **Design breaking** - AI updates content without understanding layout constraints
- **Knowledge drift** - Important project context lives only in chat history, not in code

### The Solution

By maintaining **structured markdown files** that document your project's context, you create:

1. **Version-controlled context** - Project requirements tracked in git alongside code
2. **Reusable knowledge base** - Reference the same files across multiple AI conversations
3. **Single source of truth** - Factual information documented once, used everywhere
4. **Onboarding efficiency** - New AI tools (or team members) get instant context
5. **Consistent output** - AI follows documented guidelines instead of guessing

### Core Principle

**"If you find yourself repeatedly correcting an AI on the same point, that guidance belongs in this directory."**

This approach treats AI assistants as **collaborators who need onboarding**—just like human team members need documentation, AI tools work better with clear, written context.

---

## What Belongs Here

### Project-Specific Context

Files that are **unique to this specific project**:

- Brand voice and tone guidelines
- Content update rules (preserving design, character counts)
- Business/product positioning
- Target audience definitions
- Messaging frameworks
- Project-specific terminology or naming conventions

### Subject Matter Context

Files that provide **factual information** AI shouldn't invent:

- Professional experience and background (for personal sites)
- Company history and milestones (for corporate sites)
- Team member profiles and expertise (for agency sites)
- Product features and specifications (for SaaS sites)
- Certifications, credentials, awards (for professional sites)
- Technical stack and architecture decisions

### Workflow Guidance

Files that define **how AI should work**:

- Content creation workflows
- Design constraint rules
- Code style preferences
- Quality checklists
- Common mistakes to avoid
- Approval processes

---

## What Doesn't Belong Here

### Technical Documentation

**Don't put here:**
- Code architecture guides
- API documentation
- Development setup instructions
- Deployment processes

**Put instead in:** `src/docs/` (sibling to this directory)

**Why:** Technical docs are about *how the system works*. Project context is about *what makes this project unique*.

### Generic Best Practices

**Don't put here:**
- General writing tips
- Universal design principles
- Standard accessibility guidelines

**Put instead in:** Your company's general style guide or reference docs

**Why:** This directory is for project-specific context, not universal knowledge.

### Temporary Information

**Don't put here:**
- Task lists or todos
- Meeting notes
- Temporary decisions
- Work-in-progress drafts

**Why:** Context files should be relatively stable, not constantly changing.

---

## Recommended Structure

### Minimal Setup

For simple projects, start with just 2-3 files:

```
src/docs/project/
├── README.md           # This file - explains the directory
├── tone.md             # Brand voice and writing style
└── content-rules.md    # Guidelines for content updates
```

### Standard Setup

For most projects, expand to cover key areas:

```
src/docs/project/
├── README.md              # Directory purpose and usage
├── brand/
│   ├── tone.md            # Voice, style, messaging
│   ├── positioning.md     # Market positioning, differentiation
│   └── terminology.md     # Project-specific terms and naming
├── content/
│   ├── update-rules.md    # How to update content safely
│   ├── factual-data.md    # Info AI shouldn't invent
│   └── audience.md        # Target audience profiles
└── workflow/
    ├── quality-checklist.md
    └── common-mistakes.md
```

### Complex Setup

For large projects with multiple stakeholders or brands:

```
src/docs/project/
├── README.md
├── brand/
│   ├── primary/
│   │   ├── tone.md
│   │   ├── visual-language.md
│   │   └── messaging.md
│   └── sub-brands/
│       ├── brand-a.md
│       └── brand-b.md
├── content/
│   ├── editorial-guidelines.md
│   ├── seo-requirements.md
│   ├── legal-compliance.md
│   └── sources/
│       ├── company-history.md
│       ├── product-specs.md
│       └── team-bios.md
├── audiences/
│   ├── persona-enterprise.md
│   ├── persona-startup.md
│   └── persona-individual.md
└── workflow/
    ├── content-approval-process.md
    ├── design-constraints.md
    └── quality-gates.md
```

---

## Structure by Project Type

### Personal Portfolio / Freelancer Site

**Focus:** Authentic representation of you

```
src/docs/project/
├── README.md
├── professional-background.md    # Experience, skills, achievements
├── tone.md                       # Your unique voice
├── personal-context.md           # Interests, values, story
└── service-offerings.md          # What you do, how you work
```

**Why these files:** AI needs factual data about your experience (so it doesn't invent credentials) and clear guidance on your voice (so content sounds like you, not a generic consultant).

### Corporate / Enterprise Site

**Focus:** Brand consistency and messaging discipline

```
src/docs/project/
├── README.md
├── brand/
│   ├── voice-and-tone.md         # Corporate voice guidelines
│   ├── messaging-framework.md    # Key messages, value props
│   └── visual-language.md        # Description of brand visuals
├── content/
│   ├── company-facts.md          # History, milestones, leadership
│   ├── legal-requirements.md     # Compliance, disclaimers
│   └── approved-terminology.md   # Correct product names, terms
└── workflow/
    ├── approval-process.md       # Who reviews what
    └── content-checklist.md      # Pre-publish requirements
```

**Why these files:** Corporations need strict brand governance, legal compliance, and approval workflows. These files ensure AI-generated content meets corporate standards.

### E-commerce / Product Site

**Focus:** Product accuracy and conversion optimization

```
src/docs/project/
├── README.md
├── brand/
│   └── voice-by-stage.md         # Voice changes by funnel stage
├── products/
│   ├── product-data.md           # Specs, features, benefits
│   ├── category-descriptions.md  # How to describe product categories
│   └── pricing-messaging.md      # How to talk about pricing
├── audiences/
│   ├── buyer-persona-a.md
│   └── buyer-persona-b.md
└── conversion/
    ├── cta-guidelines.md         # Call-to-action best practices
    └── urgency-scarcity.md       # When/how to use FOMO tactics
```

**Why these files:** E-commerce needs accurate product information, audience-specific messaging, and conversion-focused copy. These files prevent AI from inventing product features or using wrong terminology.

### Agency / Service Business

**Focus:** Expertise demonstration and service clarity

```
src/docs/project/
├── README.md
├── brand/
│   ├── agency-voice.md           # How the agency sounds
│   └── positioning.md            # Market position, differentiation
├── team/
│   ├── leadership.md             # Founders, executives
│   ├── team-member-bios.md       # Individual profiles
│   └── expertise-areas.md        # What the agency knows
├── services/
│   ├── service-offerings.md      # What you sell
│   ├── process-descriptions.md   # How you work
│   └── case-study-guidelines.md  # How to write case studies
└── clients/
    ├── client-list.md            # Who you've worked with
    └── testimonial-usage.md      # Approved quotes, attribution
```

**Why these files:** Agencies need to showcase expertise, demonstrate process, and maintain accurate team/client information. These files ensure AI represents capabilities accurately.

### SaaS / Software Product

**Focus:** Product clarity and feature accuracy

```
src/docs/project/
├── README.md
├── product/
│   ├── feature-descriptions.md   # What the product does
│   ├── use-cases.md              # Who uses it, how, why
│   ├── technical-specs.md        # Integrations, requirements
│   └── roadmap-messaging.md      # How to discuss future features
├── brand/
│   ├── product-voice.md          # How the product sounds
│   └── competitive-positioning.md # vs. competitors
├── audiences/
│   ├── user-personas.md
│   └── buyer-personas.md
└── conversion/
    ├── trial-messaging.md        # Free trial positioning
    └── pricing-page-rules.md     # How to present pricing
```

**Why these files:** SaaS needs technical accuracy, clear feature communication, and conversion-optimized messaging. These files prevent AI from over-promising features or misrepresenting capabilities.

### Content / Publication Site

**Focus:** Editorial standards and content consistency

```
src/docs/project/
├── README.md
├── editorial/
│   ├── editorial-voice.md        # Publication voice
│   ├── style-guide.md            # AP style, exceptions
│   ├── fact-checking.md          # Sourcing requirements
│   └── topic-guidelines.md       # What we cover, what we don't
├── authors/
│   ├── author-bios.md
│   └── contributor-guidelines.md
└── content-types/
    ├── article-structure.md      # Standard article format
    ├── review-format.md          # Product review template
    └── tutorial-format.md        # How-to article structure
```

**Why these files:** Publications need editorial consistency, fact-checking standards, and format guidelines. These files ensure AI-generated content meets journalistic standards.

---

## How to Use This Directory

### Creating Your Context Files

1. **Start minimal** - Create 2-3 files for your most critical context
2. **Document as you go** - When you repeatedly correct AI on something, add it to a file
3. **Use examples** - Show AI what "good" looks like with real examples
4. **Keep it current** - Review and update quarterly or after major changes

### Referencing Files in AI Prompts

**Explicit file references:**
```
Use the brand voice guidelines in src/docs/project/brand/tone.md
to write this About page section.
```

**Multiple file references:**
```
Write a service page using the voice from src/docs/project/brand/tone.md
and the service descriptions from src/docs/project/services/offerings.md.
Match the character counts specified in src/docs/project/content/update-rules.md.
```

**Directory-level references:**
```
Review all files in src/docs/project/ to understand this project's
context, then update the homepage content accordingly.
```

### Template for New Files

When creating a new context file:

```markdown
# [File Purpose - e.g., "Brand Voice Guidelines"]

## Purpose
[1-2 sentences explaining what this file contains and why it exists]

## [Section Name]
[Content organized in clear sections with headers]

### Examples

#### ❌ Don't do this:
[Bad example with explanation]

#### ✅ Do this instead:
[Good example with explanation]

## Checklist
- [ ] [Verification point 1]
- [ ] [Verification point 2]

---
Last updated: [Date]
```

---

## Best Practices

### 1. Be Specific, Not Generic

**Bad (too generic):**
```markdown
Use professional language and maintain brand consistency.
```

**Good (specific and actionable):**
```markdown
Voice Characteristics:
- Direct, declarative sentences (not flowery or verbose)
- Technical depth without jargon (explain acronyms on first use)
- Revenue-focused language ("drove 40% increase" not "improved performance")
- No consultant buzzwords (synergy, leverage, stakeholder, etc.)

Example: "I find what drives revenue, build it, then show you how to own it."
NOT: "I leverage cross-functional expertise to drive synergistic outcomes."
```

### 2. Use Examples Liberally

Show AI what you want:
- ✅ Good copy examples vs. ❌ bad copy examples
- ✅ Approved terminology vs. ❌ terms to avoid
- ✅ Correct formatting vs. ❌ incorrect formatting

### 3. Document Constraints

If there are hard rules, state them clearly:
- Character count limits for template sections
- Required legal disclaimers
- Mandatory brand elements
- Prohibited topics or language

### 4. Explain the "Why"

Help AI understand reasoning:
```markdown
## Why We Don't Use Stock Photos

Stock photos reduce trust and conversions. Our data shows authentic
team photos increase contact form submissions by 23%.

Rule: Only use actual photos of our team, office, and work.
```

### 5. Keep Files Focused

Each file should have a **single clear purpose**:
- ✅ `brand/tone.md` - Just voice and style
- ✅ `content/update-rules.md` - Just content update guidelines
- ❌ `everything.md` - A 5000-line file with all context mixed together

### 6. Version Control Your Context

Commit context files to git:
- Track changes to brand guidelines over time
- Revert if new guidance doesn't work
- See evolution of messaging and positioning
- Collaborate with team on context updates

---

## Maintenance

### When to Update Files

**Immediately update when:**
- Brand voice changes or evolves
- New products/services launch
- Company/personal milestones occur
- Legal/compliance requirements change
- You find yourself repeatedly correcting AI on something

**Review quarterly:**
- Is the content still accurate?
- Are examples still relevant?
- Have any constraints changed?
- Are files still well-organized?

### Keep Files Clean

**Do:**
- Remove outdated information
- Update examples to reflect current best practices
- Merge redundant files
- Split files that have grown too large

**Don't:**
- Leave outdated context that contradicts current reality
- Keep "draft" or "maybe" content in active files
- Mix multiple unrelated topics in one file

---

## Advanced Patterns

### Multi-Language Support

For international projects:

```
src/docs/project/
├── en-US/
│   ├── tone.md
│   └── content-rules.md
├── es-ES/
│   ├── tone.md
│   └── content-rules.md
└── shared/
    └── brand-values.md
```

### Environment-Specific Context

For projects with staging vs. production content differences:

```
src/docs/project/
├── shared/
│   └── tone.md
├── production/
│   ├── approved-claims.md
│   └── legal-disclaimers.md
└── staging/
    └── testing-content.md
```

### Role-Based Context

For teams with different AI use cases:

```
src/docs/project/
├── for-content-writers/
│   ├── editorial-guidelines.md
│   └── seo-requirements.md
├── for-designers/
│   ├── visual-language.md
│   └── component-usage.md
└── for-developers/
    ├── technical-architecture.md
    └── data-requirements.md
```

---

## Integration with Development Workflow

### Reference in Code Comments

```html
<!--
  Content for this section should follow voice guidelines:
  See: src/docs/project/brand/tone.md
-->
<section class="about">
  ...
</section>
```

### Use in Pull Request Templates

```markdown
## Content Changes Checklist
- [ ] Follows voice guidelines (src/docs/project/brand/tone.md)
- [ ] Factual accuracy verified (src/docs/project/content/facts.md)
- [ ] Matches design constraints (src/docs/project/content/update-rules.md)
```

### Include in Onboarding

New team members (human or AI):
1. Read `src/docs/project/README.md`
2. Review all files in `src/docs/project/`
3. Reference these files when creating content

---

## Common Questions

### Q: How is this different from a style guide?

**A:** A style guide typically covers visual design (colors, typography, layouts). This directory covers **project context**—brand voice, factual information, content rules, and workflow guidance specific to this project.

### Q: Should I put technical documentation here?

**A:** No. Technical docs about how the codebase works belong in `src/docs/`. This directory is for context about **what makes this project unique** (brand, content, audience), not how the code functions.

### Q: How detailed should these files be?

**A:** Detailed enough that an AI assistant (or new team member) could produce work that matches your standards without additional guidance. If you find yourself repeatedly correcting the same issues, add more detail.

### Q: Can I use this for multiple projects?

**A:** Each project should have its own `src/docs/project/` directory. If you work across multiple projects, each one gets its own context files reflecting its unique requirements.

### Q: What if my brand is still evolving?

**A:** Start with your current understanding and iterate. It's better to have a draft context file you update than no context at all. These files should evolve with your project.

---

## Getting Started

### Step 1: Identify Your Critical Context

Ask yourself:
- What do I repeatedly explain to AI tools?
- What information must be accurate (no hallucinations)?
- What are the non-negotiable rules for this project?
- What makes this project's voice/brand unique?

### Step 2: Create 2-3 Core Files

Start small:
1. **Brand voice** - How should content sound?
2. **Factual data** - What information must be accurate?
3. **Content rules** - What constraints exist?

### Step 3: Test with AI

Reference your new files in prompts and see if AI output improves. Refine files based on what's missing or unclear.

### Step 4: Expand as Needed

Add new files when you identify gaps or new categories of context that need documentation.

---

## Success Metrics

You'll know this approach is working when:

- ✅ AI generates on-brand content without extensive correction
- ✅ You spend less time re-explaining context in conversations
- ✅ Content remains consistent across multiple AI sessions
- ✅ New AI tools can quickly understand your project
- ✅ Team members reference these files for clarity
- ✅ You catch and prevent factual errors before they ship

---

## Related Documentation

- **[CLAUDE.md](../../CLAUDE.md)** - Theme architecture and development workflow
- **[block-markup-guide.md](../block-markup-guide.md)** - Universal Block syntax reference
- **[styles-guide.md](../styles-guide.md)** - CSS architecture documentation

---

**Summary:**

This directory is your **AI context layer**—structured markdown files that give AI assistants (and team members) the persistent knowledge they need to work effectively on your project. By documenting voice, constraints, and factual information once, you enable consistent, accurate, on-brand output across all AI-assisted work.

The structure you choose depends on your project type and complexity, but the principle remains the same: **if you repeatedly explain it, document it here.**

---

**Version:** 1.0.0
**Last Updated:** 2025-01-21
