[Skip to content](https://umbral.ai/fast-group-scheduling-ai-assistant-embedded-chat-app-voiceflow-wordpress/#main)

- [Home](https://umbral.ai/)
- [Services](https://umbral.ai/services/)
- [About Us](https://umbral.ai/about-us/)
- [Blog](https://umbral.ai/blog/)

[![Umbral Enterprise](https://umbral.ai/wp-content/uploads/2025/02/umbral-light.svg)![Umbral Enterprise](https://umbral.ai/wp-content/uploads/2025/02/umbral-dark.png)](https://umbral.ai/)

- [More](https://umbral.ai/fast-group-scheduling-ai-assistant-embedded-chat-app-voiceflow-wordpress/#)
  - [Home](https://umbral.ai/)
  - [Services](https://umbral.ai/services/)
  - [About Us](https://umbral.ai/about-us/)
  - [Blog](https://umbral.ai/blog/)

[Schedule Today](https://umbral.ai/contact-us)

[![Umbral Enterprise](https://umbral.ai/wp-content/uploads/2025/02/umbral-light.svg)![Umbral Enterprise](https://umbral.ai/wp-content/uploads/2025/02/umbral-dark.png)](https://umbral.ai/)

Menu

# Fast Group Scheduling AI Assistant — Embedded Chat App ( @Voiceflow   @WordPress )

- [![conner](https://secure.gravatar.com/avatar/dc50ae278e3bad240658d146b9c44774a7608321e16c971f5e4dbf0dd2f3e80e?s=50&d=mm&r=g)](https://umbral.ai/author/conner/)[conner](https://umbral.ai/author/conner/ "Posts by conner")
- March 14, 2025
- [AI Workflow](https://umbral.ai/category/ai-workflow/)

Fast Group Scheduling AI Assistant -- Embedded Chat App (@Voiceflow @WordPress) - YouTube

[Photo image of Umbral](https://www.youtube.com/channel/UCLgwwlJ6xgxN9qt75Kgw4Ng?embeds_referring_euri=https%3A%2F%2Fumbral.ai%2F)

Umbral

5.42K subscribers

[Fast Group Scheduling AI Assistant -- Embedded Chat App (@Voiceflow @WordPress)](https://www.youtube.com/watch?v=EZXTAzyC2nQ)

Umbral

Search

Watch later

Share

Copy link

Info

Shopping

Tap to unmute

If playback doesn't begin shortly, try restarting your device.

More videos

## More videos

You're signed out

Videos you watch may be added to the TV's watch history and influence TV recommendations. To avoid this, cancel and sign in to YouTube on your computer.

CancelConfirm

Share

Include playlist

An error occurred while retrieving sharing information. Please try again later.

[Watch on](https://www.youtube.com/watch?v=EZXTAzyC2nQ&embeds_referring_euri=https%3A%2F%2Fumbral.ai%2F)

0:00

0:00 / 17:01
•Live

•

## The Demo: Scheduling Made Simple

What’s up, chatbot builders! Today I’m excited to show you what I’m calling an enterprise-grade scheduling tool that can be custom-adjusted to your business needs. Let me walk you through the demo first so you understand the functionality, then I’ll discuss why I think this build is significant, and finally, provide a summary of the tools I used to create it.

The interface consists of two main components: an embedded chat window taking up about a third of the screen, and a larger blank area that dynamically populates based on our interactions.

### Individual Scheduling

When we open the chat, it greets us with “Hello, what meetings can I help you book today?” After selecting “I want to check availability” and choosing “Individual,” the larger portion of the screen populates with all the employees in the company, including their titles.

The interface provides immediate feedback—when you click on employees in the main window, the chatbot acknowledges your selections. You can also deselect people, and your choices are updated in real-time. For companies with hundreds of employees, there’s a search function that allows you to find specific team members without endless scrolling.

For our demo, let’s imagine we’re planning a sales meeting. I’ll select the SDRs, AEs, and VP of Sales. After clicking “Complete Selection” in the chat, the system searches for available times when all five individuals are free. Within seconds, it suggests three time slots.

When we select a time (Friday at 10 AM), the system asks whether we want to book directly or ask permission first. This gives flexibility to different workflow preferences—executive assistants might book directly, while others might prefer to send a confirmation request. Selecting “Book Now” prompts a final confirmation, and then the meeting is scheduled. All attendees receive email confirmations, and the event appears in everyone’s calendar.

### Group Scheduling

The system also supports group-based scheduling. Instead of selecting individuals one by one, you can choose predefined groups like “Sales.” When we check availability for the Sales group, notice that our previously booked 10 AM slot is no longer available—the system is updating in real-time based on calendar changes.

We can even check availability for the entire company (all 23 employees). As expected, there are fewer suitable time slots when coordinating so many calendars—in this case, only 4:30 PM on Thursdays works for everyone.

### Group Management

A powerful feature is the ability to create and manage groups directly within the chat interface. By selecting “Create New Group,” you can name your group (e.g., “Hello YouTube”) and select which employees to include. The system confirms the creation and displays the members with their titles.

You can also view existing groups, see who’s in each group, modify groups, or delete them as needed—all without leaving the chat interface.

## Why This Matters

What makes this tool significant is its flexibility. It’s not limited to internal employees—you can include vendors and external partners who use different calendar systems (Gmail, Outlook, etc.). They don’t need to have your domain email address to be included in the scheduling process.

The backend is built on WordPress—instead of content management, we’re using it for calendar management. This gives you complete ownership of the data, unlike solutions like Calendly where you’re locked into their interface, features, and per-seat pricing model.

This demonstrates the power of building custom, bespoke integrated chat solutions tailored to exactly what you want to see. The real breakthrough is the interactivity between the chat and the web page—actions in one immediately affect the other, creating a seamless user experience.

## How It’s Built

The system combines two main technologies:

1. **[WordPress](https://wordpress.org/)** for the backend, using:

   - Advanced Custom Fields to store employee and group data
   - Custom post types for groups
   - Fluent Booking for API integration with calendars
2. **[Voiceflow](https://voiceflow.com/)** for the chatbot, leveraging:

   - Custom Extensions for interactive elements
   - Multi-select functionality
   - Button interfaces
   - Payload handlers to process selections
   - Webhooks connected to [Make.com](https://make.com/en) for the prototype (though this could connect to any system)

The magic happens through Voiceflow’s Extensions feature. I’ve created two main extensions:

- A multi-select extension for choosing employees
- A multiple buttons extension for selecting time slots

From a logic perspective, the chatbot is relatively straightforward. It uses custom actions that pause the conversation flow while waiting for user interaction on the webpage. Once selections are made, it parses the payload and continues the conversation, eventually triggering webhooks to handle the calendar bookings.

## The Bigger Picture

This project represents something unique in the scheduling space. I don’t believe there’s currently a SaaS product on the market that allows you to check group availability this quickly and intuitively.

What’s particularly interesting is that this entire solution doesn’t rely on AI or LLMs at all. It proves that tools like Voiceflow can be used to build full-scale applications with embedded chat interfaces, not just conversational AI assistants.

I’m planning to develop more of these custom embedded chat user experiences, focusing on creating powerful, intuitive interfaces that solve specific business problems. If you’re interested in having something similar built for your company, feel free to reach out—I’ll have a landing page up soon for this micro-product.

## Leave a Reply[Cancel Reply](https://umbral.ai/fast-group-scheduling-ai-assistant-embedded-chat-app-voiceflow-wordpress/\#respond)

Your email address will not be published.Required fields are marked \*

Name **\***

Email **\***

Website

Add Comment **\***

Save my name, email and website in this browser for the next time I comment.

Post Comment

![](https://umbral.ai/wp-content/uploads/2025/02/umbral-light.svg)

Practical AI solutions for business workflows.

##### Platforms

- [Voiceflow](https://voiceflow.com/)
- [Microsoft CoPilot Studio](https://www.microsoft.com/en-us/microsoft-copilot/microsoft-copilot-studio)
- [Google Vertex AI](https://cloud.google.com/generative-ai-studio)
- [IBM WatsonX Assistant](https://www.ibm.com/products/watsonx-assistant)

##### Services

- [Automation](https://umbral.ai/fast-group-scheduling-ai-assistant-embedded-chat-app-voiceflow-wordpress/#contact-us)
- [Chat Assistants](https://umbral.ai/contact-us)
- [Voice Agents](https://umbral.ai/fast-group-scheduling-ai-assistant-embedded-chat-app-voiceflow-wordpress/#contact-us)
- [MVP Development](https://umbral.ai/fast-group-scheduling-ai-assistant-embedded-chat-app-voiceflow-wordpress/#contact-us)

##### Contact Us

[Book A Discovery Call](https://umbral.ai/contact-us)

**Email**: support@umbral.ai

Copyright © 2025 - [**Umbral.ai**](https://umbral.ai/)