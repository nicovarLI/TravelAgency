
# Light-it Pull Request Template ⚡⚡⚡

_Resolve_: [closes -###](https://link-to-your-ticket)

## Description ⭐

<!--
Please include a summary of the change and which issue is fixed. Please also include relevant motivation and context. List any dependencies that are required for this change.
Example:
-->

I've added support for authentication to implement Key Result 2 of OKR1. It includes
model, table, controller and test. For more background, see ticket #CU-834794.

### Type of change 🏃

- [ ] Bug fix (non-breaking change which fixes an issue)
- [ ] New feature (non-breaking change which adds functionality)
- [ ] Breaking change (fix or feature that would cause existing functionality not to work as expected)
- [ ] This change requires a documentation update

### Requires ❗

- [ ] This change requires a database update or migration
- [ ] This change requires a documentation update

### Anything Else? 🙈

<!--
You may want to delve into possible architecture changes or technical debt here. Call out challenges, optimizations, etc. Example:
-->

Let's consider using a 3rd party authentication provider for this, to offload MFA and other considerations as they arise and the privacy landscape evolves. AWS Cognito is a good option, so is Firebase. I'm happy to start researching this path.

## Screenshots (optional) 📷

Include Screenshots if necessary.

## How Has This Been Tested? ❓

<!--
Please describe the tests that you ran to verify your changes. Provide instructions so we can reproduce. Please also list any relevant details for your test configuration
-->

- [ ] Test A
- [ ] Test B

## Checklist ✅

- [ ] My code follows the style guidelines of this project
- [ ] I have performed a self-review of my own code
- [ ] I have made corresponding changes to the documentation
- [ ] My changes generate no new warnings
- [ ] I have added tests that prove my fix is effective or that my feature works
- [ ] New and existing unit tests pass locally with my changes
- [ ] Any dependent changes have been merged and published in downstream modules

## Emoji Guide

**For reviewers: Emojis can be added to comments to call out blocking versus non-blocking feedback.**

E.g., Praise, minor suggestions, or clarifying questions that don’t block merging the PR.

> 🟢 Nice refactor!
> 🟡 Why was the default value removed?

E.g., Blocking feedback must be addressed before merging.

> 🔴 This change will break something important

|              |                |                                     |
| ------------ | -------------- | ----------------------------------- |
| Blocking     | 🔴 ❌ 🚨       | RED                                 |
| Non-blocking | 🟡 💡 🤔 💭    | Yellow, thinking, etc               |
| Praise       | 🟢 💚 😍 👍 🙌 | Green, hearts, positive emojis, etc |

## Links

- [Git Flow](https://lightit.slite.com/app/docs/SC8usN2Ju)
- [Handbook of good practices for reviewers in Code Reviews](https://lightit.slite.com/app/docs/ddNGohWthVB3fO)
